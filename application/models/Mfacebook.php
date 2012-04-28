<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mfacebook extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function checkuser($me)
    {   
    	$user = array();
    	$limit = 1;
    	$id = $me['id'];
    	$options = array('facebook_user_id'=>$id);
    	$Q = $this->db->get_where('fb_users',$options,$limit);
    	if ($Q->num_rows() > 0)
        {
            $user = $Q->row_array();
        }
        $Q->free_result(); 

	    //$q = sprintf("select * from users where facebook_user_id='%s' limit 1", r($me->id));
	    //$rs = mysql_query($q);
	    //$user = mysql_fetch_assoc($rs);

	    return $user;		
    }


    function insert_user($me)
    {
    	/*
    	 $q = sprintf("insert into users (facebook_user_id, facebook_name, facebook_picture, facebook_access_token, created, modified) values ('%s','%s','%s','%s',now(),now());",
	            r($me->id),
	            r($me->name),
	            r($me->picture),
	            r($access_token));
	        $rs = mysql_query($q);

	        // 挿入されたデータをひっぱってきて$userにセット
	        $q = sprintf("select * from users where id=%d limit 1", mysql_insert_id());
	        $rs = mysql_query($q);
	        $user = mysql_fetch_assoc($rs);
		*/
        $data = array(
        	'facebook_user_id'=>$me['id'],
        	'facebook_name' =>$me['name'],
        	'facebook_picture'=>$me['link'],
            'email' =>$me['email'],
        	);
        $this->db->insert('fb_users',$data);
/*
        $user_id = $this->db->insert_id();

        $user = array();
    	$limit = 1;
    	$options = array('id'=>$user_id);
    	$Q = $this->db->get_where('fb_users',$options,$limit);
    	*/
    	/*
    	$Q = sprintf("select * from users where id=%d limit 1", mysql_insert_id());
    	if ($Q->num_rows() > 0)
        {
            $user = $Q->row_array();
        }
        $Q->free_result(); 

        return $user;
        */
    }

    function checkuser_byid($me)
    {   
    	$user = array();
    	$limit = 1;
    	$id = r($me->id);
    	$options = array('facebook_user_id'=>$id);
    	$Q = $this->db->get_where('fb_users',$options,$limit);
    	if ($Q->num_rows() > 0)
        {
            $user = $Q->row_array();
        }
        $Q->free_result(); 

	    //$q = sprintf("select * from users where facebook_user_id='%s' limit 1", r($me->id));
	    //$rs = mysql_query($q);
	    //$user = mysql_fetch_assoc($rs);

	    return $user;		
    }

}
