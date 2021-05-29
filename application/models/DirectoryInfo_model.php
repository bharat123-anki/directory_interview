<?php
class DirectoryInfo_model extends CI_Model
{

        public function getAllDirecetoryInfoData($user_id = '', $condition = array())
        {

                $this->db->select('di.*,DATE(created_at) AS c_day');
                $this->db->from('directory_info di');
                $this->db->where('di.is_deleted', 0);
                if (!empty($condition['first_name'])) {
                        $first_name = $condition['first_name'];
                        $this->db->where('di.first_name', $first_name);
                }
                if (!empty($condition['mobile_no'])) {
                        $mobile_no = $condition['mobile_no'];
                        $this->db->where('di.mobile_no', $mobile_no);
                }
                $this->db->where('di.user_id', $user_id);
                $this->db->order_by('di.id', 'DESC');
                $query = $this->db->get()->result_array();

                return ($query);
        }
        public function getDirectoryDataById($id)
        {

                $sql = "SELECT di.*,dd.max_number As view_count FROM directory_info di LEFT JOIN (SELECT dcl.*,Sum(count) As max_number FROM `directory_count_logs` dcl GROUP by directory_id) As dd on di.id = dd.directory_id where di.id='" . $id . "' ";
                $query = $this->db->query($sql);
                return ($query->row_array());
        }
        public function increaseviewCount($id)
        {
                $date = date("Y-m-d", strtotime("now"));
                $this->db->select('dcl.*');
                $this->db->from('directory_count_logs dcl');
                $this->db->where('dcl.directory_id', $id);
                $this->db->where('dcl.date', $date);
                $query = $this->db->get()->result_array();
                if (empty($query)) {
                        $ans = $this->db->insert('directory_count_logs', array('directory_id' => $id, 'date' => $date, 'count' => 1));
                } else {
                        $query = "UPDATE directory_count_logs SET count = count + 1 WHERE directory_id = '" . $id . "' AND date = '" . $date . "' ";
                        $ans = $this->db->query($query);
                }
                if ($this->db->affected_rows() > 0) {
                        return true;
                }
        }

        public function getDirectoryLogs($id)
        {
                $start_date = date("Y-m-d", strtotime("now"));
                $end_date = date("Y-m-d", strtotime("-7 days"));
                $sql = "SELECT * FROM `directory_count_logs` where date between '" . $end_date . "' and '" . $start_date . "' AND directory_id = '" . $id . "' ORDER BY DATE DESC ";
                $query = $this->db->query($sql);
                $ans = $query->result_array();
                return $ans;
        }

        public function getSearchFormData($id = '')
        {
                $this->db->select('di.*');
                $this->db->from('directory_info di');
                $this->db->where('di.is_deleted', 0);
                $this->db->where('di.user_id', $id);
                $this->db->order_by('di.id', 'DESC');
                $ans = $this->db->get()->result_array();
                return $ans;
        }
}
