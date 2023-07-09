<?php
namespace App\models;
use App\config\database;
use Core\BaseModel;
class MemberModel extends BaseModel{
    public function checkMember($user_mail)
    {
        $sql = "SELECT * FROM users WHERE email = '$user_mail'";
        $result = $this->db->runQuery($sql);
        
        $memberinfos = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $memberinfo = array(
                    'user_id' => $row['id'],
                    'user_firstname' => $row['first_name'],
                    'user_lastname' => $row['last_name'],
                    'user_email' => $row['email'],
                    'user_mobile' => $row['mobile'],
                    'user_address' => $row['address'],
                );

                $memberinfos[] = $memberinfo;
            }
    
        return $memberinfos;
        }
    }
}


