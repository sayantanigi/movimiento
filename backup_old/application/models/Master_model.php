<?php
class Master_model extends CI_Model {
    var $table;
    function __construct() {
        parent::__construct();
    }

    function getNew($table = false) {
        if ($table) {
            $this->table = $table;
        }
        $f = $this->db->list_fields($this->table);
        $temp = new stdClass();
        $temp->id = false;
        foreach ($f as $fields) {
            $temp->$fields = '';
        }
        return $temp;
    }
    function getRow($id, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        return $this->db->get_where($this->table, array('id' => $id))->first_row();
    }
    function getAll_members($offset = 0, $limit = 40, $table = false) {
        $this->db->select('users.*,c.course_id,c.enrollment_id');
        $this->db->from($table);
        if ($table) {
            $this->table = $table;
        }
        $this->db->join('course_enrollment c', 'c.user_id = users.id', 'LEFT');
        $this->db->group_by('users.id');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get();
        // $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        // echo $this->db->last_query(); die;
        $data['total'] = $this->db->get($this->table)->num_rows();
        return $data;
    }

    function getAll($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        // echo $this->db->last_query(); die;
        $data['total'] = $this->db->get($this->table)->num_rows();
        return $data;
    }
    function getAllproductpurchesed($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table1 = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table1);
        $data['results'] = $rest->result();
        // echo $this->db->last_query(); die;
        $data['total'] = $this->db->get($this->table1)->num_rows();
        return $data;
    }
    function getAlleventpurchesed($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table2 = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table2);
        $data['results'] = $rest->result();
        // echo $this->db->last_query(); die;
        $data['total'] = $this->db->get($this->table2)->num_rows();
        return $data;
    }
    function getAllcoursepurchesed($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table3 = $table;
        }
        $this->db->order_by('enrollment_id', 'DESC');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table3);
        $data['results'] = $rest->result();
        // echo $this->db->last_query(); die;
        $data['total'] = $this->db->get($this->table3)->num_rows();
        return $data;
    }
    function getAllcertificate($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $this->db->where('payment_status', 'Completed');
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get_where($this->table, array('payment_status' => 'Completed'))->num_rows();
        echo $this->db->last_query();
        return $data;
    }
    function getAllcomp($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->where('cat_id', 1);
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->where('cat_id', 1)->get($this->table)->num_rows();
        //echo $this->db->last_query();die;
        return $data;
    }
    /*function getAllCourse($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        $this->db->select('t1.*, t2.name');
        $this->db->from('courses as t1');
        $this->db->order_by('t1.id', 'DESC');
        $this->db->join('cr_category as t2', 't1.cat_id = t2.id', 'INNER');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get();
        $data['results'] = $rest->result();
        // echo $this->db->last_query();die;
        $data['total'] = $this->db->get($this->table)->num_rows();
        return $data;
    }*/
    function getAllCourse($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        $this->db->select('t1.*');
        $this->db->from('courses as t1');
        $this->db->order_by('t1.id', 'DESC');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get();
        $data['results'] = $rest->result();
        // echo $this->db->last_query();die;
        $data['total'] = $this->db->get($this->table)->num_rows();
        return $data;
    }
    function getAllcert($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->where('cat_id', 2);
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->where('cat_id', 2)->get($this->table)->num_rows();
        //echo $this->db->last_query();die;
        return $data;
    }
    function getAllsubscr($offset = 0, $limit = 40, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->where('cat_id', 3);
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->where('cat_id', 3)->get($this->table)->num_rows();
        //echo $this->db->last_query();die;
        return $data;
    }

    function getAllSearched($offset = 0, $limit = 40, $likes = array(), $table = false) {
        if ($table) {
            $this->table = $table;
        }
        if (count($likes) > 0) {
            foreach ($likes as $key => $val) {
                $this->db->or_like($key, $val);
            }
        }
        $this->db->order_by('id', 'DESC');
        $sql = $this->db->get_compiled_select($this->table, false);
        $this->db->limit($limit, $offset);
        $rest = $this->db->get();
        $data['results'] = $rest->result();
        $data['total'] = $this->db->query($sql)->num_rows();
        return $data;
    }
    function getWhereRecords($limit = 40, $offset = 0, $rules = array(), $table = false) {
        $this->db->order_by('id', 'DESC');
        if ($table) {
            $this->table = $table;
        }
        if (is_array($rules) && count($rules) > 0) {
            foreach ($rules as $key => $value) {
                $this->db->or_where($key, $value);
            }
        }
        $sql = $this->db->get_compiled_select($this->table, false);
        $this->db->limit($limit, $offset);
        $rest = $this->db->get();
        $data['results'] = $rest->result();
        $data['total'] = $this->db->query($sql)->num_rows();
        return $data;
    }
    function listAll($table = false) {
        if ($table) {
            $this->table = $table;
        }
        $rest = $this->db->get($this->table);
        return $rest->result();
    }
    function listAllByDesc($table = false) {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $rest = $this->db->get($this->table);
        return $rest->result();
    }
    function save($data, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        if ($data['id']) {
            $this->db->update($this->table, $data, array('id' => $data['id']));
            return $data['id'];
        } else {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }
    function delete($id, $table = false) {
        if ($table) {
            $this->table = $table;
        }
        $this->db->delete($this->table, array('id' => $id));
    }
    function get_unique_url($url, $id = false) {
        $this->db->select('slug, id');
        $this->db->where('slug', $url);
        $rest = $this->db->get($this->table);
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->id == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_unique_url($url, $id);
            }
        }
    }
    function totalCount() {
        return $this->db->get($this->table)->num_rows();
    }
}
