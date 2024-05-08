<?php class AI_Post
{
    var $id;
    var $row;
    var $status;
    var $image_src;

    function __construct($id)
    {
        $this->id = $id;
        $CI =& get_instance();
        $row = $CI->Post_model->page($id);
        $this->status = $row['status'];
        $this->image_src = $row['image'];
        $this->row = $row;
    }

    function __get($key)
    {
        if (isset($this->row[$key])) {
            return $this->row[$key];
        } else {
            return FALSE;
        }
    }

    function __set($key, $val)
    {
        $this->row[$key] = $val;
    }

    function ID()
    {
        return $this->id;
    }

    function title()
    {
        return $this->row['title'];
    }

    function data($key)
    {
        if (isset($this->row[$key])) {
            return $this->row[$key];
        } else {
            return NULL;
        }
    }

    function hasImage()
    {
        if (isset($this->row['image'])) {
            return true;
        } else {
            return false;
        }
    }

    function description()
    {
        return $this->row['content'];
    }

    function excerpt()
    {
        if ($this->data('excerpt') <> '') {
            return $this->data('excerpt');
        } else {
            $text = $this->description();
            $text = strip_tags($text);
            $text = word_limiter($text, 30);
            return $text;
        }
    }

    function metaTitle()
    {
        return $this->data('meta_title');
    }

    function metaDescription()
    {
        return $this->data('meta_description');
    }

    function metaKeywords()
    {
        return $this->data('meta_keywords');
    }

    function permalink()
    {
        $link = site_url() . 'info/' . $this->data('slug');
        return $link;
    }

    function image($size = 'sm', $options = array())
    {
        $str = '<img src="' . base_url(upload_dir($this->row['image'])) . '" alt="' . $this->title() . '" title = "' . $this->title() . '" ' . $this->__arr_to_str($options) . ' />';
        return $str;
    }

    private function __arr_to_str($arr)
    {
        $str = '';
        foreach ($arr as $key => $value) {
            $str .= $key . '="' . $value . '" ';
        }
        return $str;
    }

    public static function create($id)
    {
        $p = new AI_Post($id);
        return $p;
    }
}