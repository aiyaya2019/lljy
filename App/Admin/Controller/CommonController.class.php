<?php
namespace Admin\Controller;
use Think\Controller;
Class CommonController extends Controller{
	//自动运行方法判断权限和是否登录
	Public function _initialize(){
		if(!isset($_SESSION['admin_id'])){
			$this->redirect('Login/index');
        }
        $access = \Org\Util\Rbac::AccessDecision();
        if(!$access){
            $this->error('没有权限');
        }
	}
	/* 发送邮件
     * @param string $to 收件者
     * @param string $subject 主题
     * @param string $body 内容
     * @param string $attachment 附件
     * @return rs 发送状态
     */
	public function sendMail($to, $subject, $body = '', $attachment = null) {
	    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
	    if (!preg_match($pattern, $to)) {
	        return "email_error";
	    }
	    //邮件服务器配置
	    $detail = S('emailconfig');
	    $title = getGb2312("邮箱提醒");
	    import('Class.phpmailer.phpmailer',APP_PATH,'.php');
	    $mail = new \PHPMailer(); //PHPMailer对象
	    $mail->CharSet = 'GB2312'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
	    $mail->Encoding = "base64";
	    $mail->IsSMTP();  // 设定使用SMTP服务
	    $mail->SMTPDebug = 0;                     // 关闭SMTP调试功能
	    $mail->SMTPAuth = true;                  // 启用 SMTP 验证功能
	    $mail->SMTPSecure = 'SSL';                 // 使用安全协议
	    $mail->Host = $detail['smpt'];  // SMTP 服务器
	    $mail->Port = "25";  // SMTP服务器的端口号
	    $mail->Username = $detail['account'];  // SMTP服务器用户名
	    $mail->Password = $detail['pwd'];  // SMTP服务器密码
	    $mail->Subject = getGb2312($subject); //邮件标题
	    $mail->SetFrom($detail['account'], $title);
	    $mail->MsgHTML(getGb2312($body));
	    $mail->AddAddress(getGb2312($to), $title);
	    if (is_array($attachment)) { // 添加附件
	        foreach ($attachment as $file) {
	            is_file($file) && $mail->AddAttachment($file);
	        }
	    }
	    $rs = $mail->Send() ? true : $mail->ErrorInfo;
	    return $rs;
	}
	/* 上传图片
     * @param string $path 上传的路径，于/Uploads/Admin/".$path."/"下
     * @return array 上传的状态
     */
	public function uploadsImg(){
		$path = $_GET['path'];
		$typeArr = array("jpg", "png", "gif", "jpeg", "mov", "gears", "html5", "html4", "silverlight", "flash"); 
		$path = "Uploads/Admin/".$path."/"; //上传路径
		if (isset($_POST)) {
		    $name = $_FILES['file']['name'];
		    $size = $_FILES['file']['size'];
		    $name_tmp = $_FILES['file']['tmp_name'];
		    if (empty($name)) {
		        echo json_encode(array("error" => "您还未选择文件"));
		        exit;
		    }
		    $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
		    if (!in_array($type, $typeArr)){
		        echo json_encode(array("error" => "清上传指定类型的文件！","type"=>"types"));
		        exit;
		    }
		    if ($size > (50000 * 1024)) { //上传大小
		        echo json_encode(array("error" => "文件大小已超过50000KB！","type"=>"size"));
		        exit;
		    }
		    $pic_name = time() . rand(10000, 99999) . "." . $type; //文件名称
		    $pic_url = $path . $pic_name; //上传后图片路径+名称
		    if (move_uploaded_file($name_tmp, $pic_url)) { //临时文件转移到目标文件夹
		        echo json_encode(array("error" => "0", "pic" => __ROOT__.'/'.$pic_url, "name" => $pic_name));
		    } else {
		        echo json_encode(array("error" => "上传有误，清检查服务器配置！","type"=>"config"));
		    }
		}
	}
	/* 导出数据表
     * @param string $data 收件者
     * @param string $name 到出文件的名称
     * @return 导出结果
     */
	Public function Down($data,$name){
		$dir=dirname(__FILE__);
		$rs = import('Class.PHPExcel',APP_PATH,'.php');
		$obj=new \PHPExcel();          //实例化对象
		$objSheet=$obj->getActiveSheet();   //获取当前的活动sheet的操作对象
		$objSheet->setTitle('导出记录');          //给当前活动sheet设置名称
		$objSheet->fromArray($data);              //直接加载数据（数组）来填充数据
		$objWriter = \PHPExcel_IOFactory::createWriter($obj,'Excel2007');  //按照指定格式生成excel文件
		$objWriter->save($dir.'/Down/('.date('Y-m-d').').xlsx');                             //保存excel文件与某个目录之下
		$filename = $dir.'/Down/('.date('Y-m-d').').xlsx';
		header('content-disposition:attachment;filename='.$name.'('.date('Y-m-d').').xlsx');
		header('content-length:'.filesize($filename));
		readfile($filename);
	}
	/* 查询单条数据
     * @param string $table 查询的表名
     * @param array $where 查询的where条件，
     * @param string $field 要查询的字段
     * @return array 查询的结果集
     */
	public function finddata($table='',$where='',$field=''){
		$fields = explode(',', $field);
		if ($fields[1] || $field=='') {
		    $data = M($table)->field($field)->where($where)->find();
		}else{
		    $data = M($table)->field($field)->where($where)->getField($fields[0]);
		}
		return $data;
	}
	/* 查询多条数据
     * @param string $table 查询的表名
     * @param array $where 查询的where条件，
     * @param string $field 要查询的字段
     * @param string $order 排序
     * @return array 查询的结果集
     */
	public function selectdata($table='',$where='',$field='',$order='id DESC',$limit){
		$data = M($table)->field($field)->order($order)->limit($limit)->where($where)->select();
		return $data;
	}
	/* 添加单条数据
     * @param string $table 查询的表名
     * @param array $data 插入的数据
     * @param string $url 插入成功后跳转的页面
     * @return methid 结果方法
     */
	public function adddata($table='',$data='',$url=''){
		if (M($table)->add($data)) {
			$this->success('添加成功！！！',$url);
		}else{
			$this->error('添加失败！！！');
		}
	}
	/* 保存修改数据
     * @param string $table 查询的表名
     * @param array $data 查询的where条件，
     * @param string $url 插入成功后跳转的页面
     * @return methid 结果方法
     */
    public function savedata($table='',$data='',$url=''){
		if (M($table)->save($data)) {
			$this->success('修改成功！！！',$url);
		}else{
			$this->error('修改失败！！！');
		}
	}
	/* 删除数据
     * @param string $table 查询的表名
     * @param array $data 查询的where条件，
     * @param string $flag 是否软删除：1是
     * @param string $url 插入成功后跳转的页面
     * @return methid 结果方法
     */
    public function deletedata($table='',$where='', $flag = ''){
    	if (!$flag) {
    		$res = M($table)->where($where)->delete();
    	}else{
    		$res = M($table)->where($where)->save(['flag' => '0', 'update_time' => time()]);
    	}
    	return $res ? true : false;
	}
	/* 分页方法
     * @param string $table 分页的表名
     * @param number $num 每页显示数量
     * @param string $where 分页的where条件
     * @return array 返回limit值和page（html）
     */
	public function Page($table,$num,$where){
		$count= M($table)->where($where)->count();
		$page= new \Think\Page($count,$num);
		$limit = $page->firstRow . ','. $page->listRows;
		$page=$page->show();
		$arr = array();
		$arr['limit'] = $limit;
		$arr['page'] = $page;
		return $arr;
	}
	public function uploads($path = 'product'){
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->savePath = 'Admin/'.$path.'/';
        $info = $upload->upload();                                        
        return $info;
    }


	 /* 文件上传功能 */
    public function OneUpload($path){
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->savePath = 'Admin/'.$path.'/';
        $info = $upload->upload();
        // print_r($info);exit;
        if ($info){
        	$path = '/Uploads/'.$info['file']['savepath'].$info['file']['savename'];
            $this->ajaxReturn(array("error" => "0", "path" => $path, 'name' => $info['file']['name']));
        }else{
            $this->error('上传失败');
        }
    }











}
?>