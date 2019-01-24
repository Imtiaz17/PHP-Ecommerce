<?php

class Database
{
    public $db;

    public function __construct()
    {
        $this->db = mysqli_connect("localhost", "root", "", "aio");
        if (!$this->db) {
            die("connection faild" . $this->db->connect_error);
        }
    }

    //insert
    public function brandinsert($query)
    {
        $brandinsert = $this->db->query($query);
        if ($brandinsert) {
            header("Location: brand.php?msg=" . urlencode('Data Inserted'));
            exit();
        } else {
            die($this->db->error);
        }
    }

    public function catinsert($query)
    {
        $catinsert = $this->db->query($query);
        if ($catinsert) {
            header("Location:category.php?msg=" . urlencode('Data Inserted'));
            exit();
        } else {
            die($this->db->error);
        }
    }

    public function insert($query)
    {
        $insert = $this->db->query($query);
        if ($insert) {
            header("Location:product.php?msg=" . urlencode('Data Inserted'));
            exit();
        } else {
            die($this->db->error);
        }
    }

    public function admininsert($query)
    {
        $admininsert = $this->db->query($query);
        if ($admininsert) {
            header("Location:index.php?msg=" . urlencode('<strong>Congrats!</strong> Successfully Created an Admin !'));
            exit();
        } else {
            die($this->db->error);
        }
    }

    //update
    public function update($query)
    {
        $update = $this->db->query($query);
        if ($update) {
            header("Location: product.php?msg=" . urlencode('Data Updated '));
            exit();
        } else {
            die($this->db->error);
        }
    }

    public function adminupdate($query)
    {
        $adminupdate = $this->db->query($query);
        if ($adminupdate) {
            header("Location: index.php?msg=" . urlencode('Data Updated Successfully! '));
            exit();
        } else {
            die($this->db->error);
        }
    }

    public function brandupdate($query)
    {
        $update = $this->db->query($query);
        if ($update) {
            header("Location: brand.php?msg=" . urlencode('Data Updated '));
            exit();
        } else {
            die($this->db->error);
        }
    }

    public function catupdate($query)
    {
        $catupdate = $this->db->query($query);
        if ($catupdate) {
            header("Location:category.php?msg=" . urlencode('Data Updated '));
            exit();
        } else {
            die($this->db->error);
        }
    }

    //delete
    public function delete($query)
    {
        $delete = $this->db->query($query);
        if ($delete) {
            header("Location: product.php?msg=" . urlencode('Data Deleted '));
            exit();
        } else {
            die($this->db->error);
        }
    }

    public function branddelete($query)
    {
        $delete = $this->db->query($query);
        if ($delete) {
            header("Location: brand.php?msg=" . urlencode('Data Deleted '));
            exit();
        } else {
            die($this->db->error);
        }
    }

    public function catdelete($query)
    {
        $catdelete = $this->db->query($query);
        if ($catdelete) {
            header("Location: category.php?msg=" . urlencode('Data Deleted '));
            exit();
        } else {
            die($this->db->error);
        }
    }

    //details
    public function getall($query)
    {
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP-Ecommerce/config.php';
require_once BASEURL . '../helpers/helpers.php';
