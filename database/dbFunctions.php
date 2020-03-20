<?php

require_once __DIR__.'/dbhandler.php';

class DatabaseFunctions {

    public function connect()
    {
        $con = new Database();
        $con = $con->connectToDB();
        return $con;
    }

    public function stmtWithotParam($sql) {
        $con = $this->connect();
        $stmt = $con->stmt_init();

        if(!$stmt->prepare($sql)) {
            exit();
        } else {
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }

    }

    public function stmtWithOneParam($sql, $param) {
        $stmt = $this->con->stmt_init();

        if(!$stmt->prepare($sql)) {
            exit();
        } else {
            $stmt->bind_param("s", $param);
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    public function stmtWithTwoParam($sql, $param1, $param2) {
        $stmt = $this->con->stmt_init();

        if(!$stmt->prepare($sql)) {
            exit();
        } else {
            $stmt->bind_param("ss", $param1, $param2);
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    public function stmtWithThreeParam($sql, $param1, $param2, $param3) {
        $stmt = $this->con->stmt_init();

        if(!$stmt->prepare($sql)) {
            exit();
        } else {
            $stmt->bind_param("sss", $param1, $param2, $param3);
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            return $result;
        } else {
            return null;
        }
    }

    public function getQuantity($sql) {
        $stmt = $this->con->stmt_init();

        if(!$stmt->prepare($sql)) {
            exit();
        } else {
            $stmt->execute();
        }

        $result = $stmt->get_result();
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $result = $row['quantity'];
            return $result;
        } else {
            return null;
        }
    }

    public function anyMatchingData($sql, $param) {
        $stmt = $this->con->stmt_init();

        if(!$stmt->prepare($sql)) {
            exit();
        } else {
            $stmt->bind_param("s", $param);
            $stmt->execute();
            $stmt->store_result();
            $resultCheck = $stmt->num_rows();
        }
        return $resultCheck;
    }

}