<?php
    //Gil says: "Thou shall not copy others' code as it is their intellectual property."
    //Gil says: "Thou shall not post others' code to Twitter and claim it as your own, as you will induce a lifetime curse of you being an approval seeker and a fake showoff."
    $conn;
    class crud_central extends CI_Model {
        public function __construct() {
            session_start();
            global $conn;
            $conn = mysqli_connect("localhost", "root", "", "mealsformakers");
        }

        //for password hashing
        function shaenc(String $value, String $type = "sha512") {
            $m = hash($type, $value);
            return $m;
        }

        //generation of random key indexes
        function genr($length = 7) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $rand = '';
            for ($i = 0; $i < $length; $i++) {
                $rand .= $characters[rand(0, (strlen($characters)) - 1)];
            }
            return $rand;
        }

        //not really used, since Prepared statements....
        function esc(String $value) {
            global $conn;
            $val = trim($value);
            $val = mysqli_real_escape_string($conn, $value);
            return $val;
        }

        //conversion of any date input to proper MySQL date format
        function convDate($dt, $includesTime = 1) {
            if (intval($includesTime) == 1) {
                return date("Y-m-d H:i:s", strtotime($dt));
            } else {
                return date("Y-m-d", strtotime($dt));
            }
        }

        //this function is for testing purposes only
        public function getUsers() {
            global $conn;
            $return_arr = array();
            $sql = "SELECT * FROM usertable";
            $stmt = $conn->prepare($sql);
            //$stmt->bind_param('i', $mainarg);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res->num_rows>0) {
                while ($a = $res->fetch_assoc()) {
                    $return_arr[] = $a;
                }
            } else {
                $return_arr = array(
                    'returned'=>"0 results"
                );
            }
            return $return_arr;
        }

        //START MAIN CRUD FUNCTIONS
        //used PDO to prevent SQL injections!!!

        //register a user with existing username checking
        public function registerUser($lastname, $firstname, $age, $birthdate, $email, $contactnum, $address, $profilePic, $username, $pword) {
            global $conn;
            $return_arr = array();
            $sql = "SELECT * FROM usertable WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res->num_rows>0) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"Username already exists!"
                );
            } else {
                $sql = "INSERT INTO `usertable`(`userIndex`, `lastname`, `firstname`, `age`, `birthdate`, `email`, `contactnum`, `address`, `profilePic`, `username`, `pword`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $randIndex = $this->genr();
                $finalAge = intval($age);
                $finalBdate = $this->convDate($birthdate, 0);
                $finalpass = $this->shaenc($pword); //asinan para sumayaw ang bulate
                $stmt->bind_param('sssisssssss', $randIndex, $lastname, $firstname, $finalAge, $finalBdate, $email, $contactnum, $address, $profilePic, $username, $finalpass );
                if ($stmt->execute()) {
                    $return_arr = array(
                        'code'=>"1",
                        'msg'=>"User is now registered!"
                    );
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Server error!"
                    );
                }
            }
            return $return_arr;
        }

        //function to update current profile
        public function updateUser($lastname, $firstname, $age, $birthdate, $email, $contactnum, $address, $profilePic, $username, $pword) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                //check if a current user is logged in.
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $userIndex = $_SESSION['userid'];
                $sql = "UPDATE `usertable` SET `lastname`= ? ,`firstname`= ? ,`age`= ? ,`birthdate`= ? ,`email`= ? ,`contactnum`= ? ,`address`= ? ,`profilePic`= ? ,`username`= ? ,`pword`= ?  WHERE userIndex = ?";
                $stmt = $conn->prepare($sql);
                $finalAge = intval($age);
                $finalBdate = $this->convDate($birthdate, 0);
                $finalpass = $this->shaenc($pword); //asinan para sumayaw ang bulate
                $stmt->bind_param('sssssssssss', $lastname, $firstname, $finalAge, $finalBdate, $email, $contactnum, $address, $profilePic, $username, $finalpass, $userIndex);
                if ($stmt->execute()) {
                    $return_arr = array(
                        'code'=>"1",
                        'msg'=>"User profile updated!"
                    );
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Server error! Failed updating profile!"
                    );
                }
                
            }
        }

        //get current user profile
        public function getUser() {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                //check if a current user is logged in.
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $userIndex = $_SESSION['userid'];
                $sql = "SELECT * FROM usertable WHERE userIndex = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $userIndex);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"User not found!"
                    );
                }
            }
            return $return_arr;
        }

        //login user function
        public function authenticateUser($username, $pword) {
            global $conn;
            $return_arr = array();
            $asin = $this->shaenc($pword);
            $sql = "SELECT * FROM usertable WHERE BINARY username = ? AND pword = ? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $username, $asin);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res->num_rows>0) {
                while ($a = $res->fetch_assoc()) {
                    $_SESSION['user'] = $a['username'];
                    $_SESSION['userid'] = $a['userIndex'];
                    $_SESSION['userfullname'] = $a['firstname'] . " " . $a['lastname'];
                    $_SESSION['nonce'] = $this->genr();
                    $return_arr = array(
                        'code'=>"1",
                        'msg'=>"User found!"
                    );
                }
            } else {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"User not found!"
                );
            }


            return $return_arr;
        }


        //function for inserting a new recipe and updating a recipe
        //mode 0 = update, mode 1 = insert
        public function insertRecipe($title, $desc, $instructions, $img, $vid, $doc, $mode = 1, $recipeIndex = "null") {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                //check if a current user is logged in.
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "SELECT * FROM recipetable WHERE recipeTitle = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $title);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Recipe title already exists!"
                    );
                } else {
                    $sql = "";
                    if (intval($mode) == 1) {
                        $sql = "INSERT INTO `recipetable`(`recipeIndex`, `userIndex`, `commIndex`, `recipeTitle`, `recipeDesc`, `recipeInstructions`, `recipeImg`, `recipeVid`, `recipeDoc`, `publishDate`, `modifyDate`, `isvisible`) VALUES (?, ?, 'nocommentbruh', ?, ?, ?, ?, ?, ?, now(), now(), 1)";
                    } else {
                        $sql = "UPDATE `recipetable` SET `recipeTitle` = ? ,`recipeDesc` = ? ,`recipeInstructions` = ? ,`recipeImg` = ?,`recipeVid` = ?,`recipeDoc` = ?,`modifyDate`=now() WHERE recipeIndex = ?";
                    }
                    $stmt = $conn->prepare($sql);
                    $randIndex = $this->genr();
                    $userIndex = $_SESSION['userid'];
                    if (intval($mode) == 1) {
                        $stmt->bind_param('ssssssss', $randIndex, $userIndex, $title, $desc, $instructions, $img, $vid, $doc);
                    } else {
                        $stmt->bind_param('sssssss', $title, $desc, $instructions, $img, $vid, $doc, $recipeIndex );
                    }
                
                    if ($stmt->execute()) {
                        $return_arr = array(
                            'code'=>"1",
                            'msg'=>"Recipe modification complete!"
                        );
                    } else {
                        $return_arr = array(
                            'code'=>"0",
                            'msg'=>"Server error!"
                        );
                    }
                }
            }
            return $return_arr;
        }


        //function for inserting / updating ingredients for a recipe
        public function insertIngredients($recipeIndex, $ingName, $ingDesc, $ingPrice, $ingPic, $ingQuan, $mode = 1) {
            global $conn;
            $return_arr = array();

            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "SELECT * FROM recipetable WHERE recipeIndex = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $recipeIndex);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows<=0) {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Recipe doesn't exist!"
                    );
                } else {
                    //check if specified ingredient already exists
                    $sql = "SELECT * FROM ingtable WHERE ingName = ? LIMIT 1";
                    $stmt = $conn->prepare($sql);
                    $loweredIng = strtolower($ingName);
                    $stmt->bind_param('s', $loweredIng);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $currentIngIndex = "null";
                    if ($res->num_rows>0) {
                        while ($a = $res->fetch_assoc()) {
                            $currentIngIndex = $a['ingIndex'];
                        }
                    } else {
                        $currentIngIndex = $this->genr();
                        $sql = "INSERT INTO `ingtable`(`ingIndex`, `ingName`, `ingDesc`, `ingPrice`, `ingPic`) VALUES (?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('sssss', $currentIngIndex, $ingName, $ingDesc, $ingPrice, $ingPic);
                        if (!$stmt->execute()) {
                            $return_arr = array(
                                'code'=>"0",
                                'msg'=>"Server Error! Failed adding ingredient!"
                            );
                        }
                    }
                    //check if recipe reference already exists
                    $sql = "SELECT * FROM recipereftable WHERE recipeIndex = ? AND ingIndex = ? LIMIT 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss', $recipeIndex, $currentIngIndex);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $currentRecRefIndex = "null";
                    if ($res->num_rows>0) {
                        while ($a = $res->fetch_assoc()) {
                            $currentRecRefIndex = $a['ingRefIndex'];
                        }
                    } else {
                        $currentRecRefIndex = $this->genr();
                    }
                    if (intval($mode) == 1) {
                        $sql = "INSERT INTO `recipereftable`(`ingRefIndex`, `recipeIndex`, `ingIndex`, `ingQuantity`) VALUES (?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('ssss', $currentRecRefIndex, $recipeIndex, $currentIngIndex, $ingQuan);
                        if (!$stmt->execute()) {
                            $return_arr = array(
                                'code'=>"0",
                                'msg'=>"Server Error! Failed adding recipe reference to the ingredient!"
                            );
                        }
                    } else {
                        //update only the quantity if mode is for updating
                        $sql = "UPDATE `recipereftable` SET `ingQuantity`= ? WHERE ingRefIndex = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('ss', $ingQuan, $currentRecRefIndex);
                        if (!$stmt->execute()) {
                            $return_arr = array(
                                'code'=>"0",
                                'msg'=>"Server Error! Failed updating recipe reference to the ingredient!"
                            );
                        }
                    }
                    $return_arr = array(
                        'code'=>"1",
                        'msg'=>"Recipe ingredient added!"
                    );
                }
            
            }

            return $return_arr;
        }

        //get all recipe summary list
        public function getAllRecipes_summary() {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = recipetable.userIndex) AS recipeauthor FROM recipetable WHERE isvisible = 1";
                $stmt = $conn->prepare($sql);
                //$stmt->bind_param('i', $mainarg);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"No recipes!"
                    );
                }
            }   
            return $return_arr;
        }

        //getting specific recipe
        public function getRecipe($recipeIndex) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = recipetable.userIndex) AS recipeauthor FROM recipetable WHERE recipeIndex = ? AND isvisible = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $recipeIndex);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Recipe not found!"
                    );
                }
            }
            return $return_arr;
        }

        //remove recipe
        public function removeRecipe($recipeIndex) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "UPDATE recipetable SET isvisible = 0 WHERE recipeIndex = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $recipeIndex);
                if ($stmt->execute()) {
                    $return_arr = array(
                        'code'=>"1",
                        'msg'=>"Recipe removed!"
                    );
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Recipe not found!"
                    );
                }
            }
            return $return_arr;
        }


        //getting ingredients from a specfic recipe
        public function getIngredients($recipeIndex) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "SELECT * FROM `recipereftable` RIGHT JOIN ingtable ON recipereftable.ingIndex = ingtable.ingIndex WHERE recipeIndex = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $recipeIndex);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Recipe reference not found! This error should not exist!"
                    );
                }
            }
            return $return_arr;
        }

        //inserting comment and rating, as well as update
        //upvoteType 1 = like, otherwise not like
        //rating 1-5
        public function insertComment($recipeIndex, $rating, $comment, $mode = 1) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $userIndex = $_SESSION['userid'];
                $sql = "SELECT * FROM commtable WHERE recipeIndex = ? AND userIndex = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $recipeIndex, $userIndex);
                $stmt->execute();
                $res = $stmt->get_result();
                $currentCommIndex = "null";
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                       $currentCommIndex = $a['commIndex'];
                    }
                } else {
                    $currentCommIndex = $this->genr();
                }
                if ($mode == 1) {
                    $sql = "INSERT INTO `commtable`(`commIndex`, `userIndex`, `rating`, `comment`, `recipeIndex`) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('sssss', $currentCommIndex, $userIndex, $rating, $comment, $recipeIndex);
                    if (!$stmt->execute()) {
                        $return_arr = array(
                            'code'=>"0",
                            'msg'=>"Server error! Can't add your comment!"
                        );
                    }
                } else {
                    $sql = "UPDATE `commtable` SET `rating`= ? ,`comment`= ?  WHERE recipeIndex = ? AND userIndex = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ssss', $rating, $comment, $recipeIndex, $userIndex);
                    if (!$stmt->execute()) {
                        $return_arr = array(
                            'code'=>"0",
                            'msg'=>"Server error! Can't update your rating and comment!"
                        );
                    }
                }
                $return_arr = array(
                    'code'=>"1",
                    'msg'=>"Comment published!"
                );
            }
            return $return_arr;
        }

        //inserting upvote
        //upvoteType 1 = like, otherwise not like
        public function toggleCommentUpvote($commIndex) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $userIndex = $_SESSION['userid'];
                $sql = "SELECT * FROM upvtable WHERE commIndex = ? AND userIndex = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $commIndex, $userIndex);
                $stmt->execute();
                $res = $stmt->get_result();
                $currentUpvIndex = "null";
                $currentUpvoteStat = 0;
                $upvExists = 0;
                $newUpvoteStat = 0;
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                       $currentUpvIndex = $a['upvoteIndex'];
                       $currentUpvoteStat = intval($a['upvoteType']);
                       $upvExists = 1;
                    }
                } else {
                    $currentUpvIndex = $this->genr();
                    $currentUpvoteStat = 1;
                }
                if ($currentUpvoteStat == 0) {
                    $newUpvoteStat = 1;
                } else {
                    $newUpvoteStat = 0;
                }
                if ($upvExists == 0) {
                    //of course, if there is no upvote exists on the current user for the current recipe,
                    //it is automatically an upvote!!
                    $sql = "INSERT INTO `upvtable`(`upvoteIndex`, `userIndex`, `upvoteType`, `commIndex`) VALUES (?, ?, 1, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('sss', $currentUpvIndex, $userIndex, $commIndex);
                    if (!$stmt->execute()) {
                        $return_arr = array(
                            'code'=>"0",
                            'msg'=>"Server error! Can't upvote!"
                        );
                    }
                } else {
                    //else if current upvote for the current user and recipe exists, thats when we toggle based on the current upvote status!
                    //dapat talaga reacts to pero tinamad na po ako, hehe, though I can customize the upvote stat since it is an integer ;)
                    $sql = "UPDATE `upvtable` SET `upvoteType`= ? WHERE upvoteIndex = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('is', $newUpvoteStat, $currentUpvIndex);
                    if (!$stmt->execute()) {
                        $return_arr = array(
                            'code'=>"0",
                            'msg'=>"Server error! Can't modify your upvote status!"
                        );
                    }
                }
                $return_arr = array(
                    'code'=>"1",
                    'msg'=>"Upvote succeed!"
                );
            }
            return $return_arr;
        }

        //getting all comments for a specific recipe
        public function getAllComments($recipeIndex) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "SELECT *, (SELECT COUNT(upvoteIndex) FROM upvtable WHERE upvtable.commIndex = commtable.commIndex) AS upvoteCount, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = commtable.userIndex) AS commentor, (SELECT usertable.profilePic FROM usertable WHERE usertable.userIndex = commtable.userIndex) AS commentorpic FROM `commtable` WHERE recipeIndex = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $recipeIndex);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Server error! Comments not found!"
                    );
                }
            }
            return $return_arr;
        }


        //insert reports
        //reportType 0 for reporting a recipe
        //reportType 1 for reporting a user
        public function insertReports($reportType, $reportContent, $reportCategory, $mindexval) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $userIndex = $_SESSION['userid'];
                $repType = intval($reportType);
                $mindex = "recipeIndex";
                if ($repType == 1) {
                    $mindex = "userIndex";
                }
                //detect if report already exists
                //note that this is index specific (recipeIndex separate from userIndex)
                $sql = "SELECT * FROM reporttable WHERE userIndex = ? AND " . $mindex . " = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $userIndex, $mindexval);
                $stmt->execute();
                $res = $stmt->get_result();
                $currentReportIndex = "null";
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $currentReportIndex = $a['reportIndex'];
                    }
                    $sql = "UPDATE `reporttable` SET `reportContent`= ? ,`reportCategory`= ?  WHERE reportIndex = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss', $reportContent, $reportCategory);
                    if (!$stmt->execute()) {
                        $return_arr = array(
                            'code'=>"0",
                            'msg'=>"Server error! Can't publish the report"
                        );
                    }
                } else {
                    $currentReportIndex = $this->genr();
                    $sql = "";
                    if ($repType == 1) {
                        $sql = "INSERT INTO `reporttable`(`reportIndex`, `recipeIndex`, `userIndex`, `reportType`, `reportContent`, `reportCategory`) VALUES (?, 'null', ?, ?, ?, ?)";
                    } else {
                        $sql = "INSERT INTO `reporttable`(`reportIndex`, `recipeIndex`, `userIndex`, `reportType`, `reportContent`, `reportCategory`) VALUES (?, ?, 'null', ?, ?, ?)";
                    }
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ssiss', $currentReportIndex, $mindexval, $repType, $reportContent, $reportCategory);
                    if (!$stmt->execute()) {
                        $return_arr = array(
                            'code'=>"0",
                            'msg'=>"Server error! Can't publish the report"
                        );
                    }
                }
                $return_arr = array(
                    'code'=>"1",
                    'msg'=>"Report complete!"
                );
            }
            return $return_arr;
        }

        //getting all reports
        public function getAllReports() {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = reporttable.userIndex) AS userfullname, (SELECT recipetable.recipeTitle FROM recipetable WHERE recipetable.recipeIndex = reporttable.recipeIndex) AS recipename FROM `reporttable`";
                $stmt = $conn->prepare($sql);
                //$stmt->bind_param('s', $arg);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Server error! No reports yet!"
                    );
                }
            }
            return $return_arr;
        }

        //messaging function
        public function sendMessage($userIndexTo, $msg) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $userIndex = $_SESSION['userid'];
                $randMsgIndex = $this->genr();
                $sql = "INSERT INTO `msgtable`(`msgIndex`, `userIndexFrom`, `userIndexTo`, `msgDate`, `msg`) VALUES (?, ?, ?, now(), ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssss', $randMsgIndex, $userIndex, $userIndexTo, $msg);
                if (!$stmt->execute()) {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Server error! Can't send the message"
                    );
                } else {
                    $return_arr = array(
                        'code'=>"1",
                        'msg'=>"Message sent!"
                    );
                }
            }
            return $return_arr;
        }

        //receive message
        //mode 1 = latest
        //mode 0 = all
        public function readMessages($userIndexTo, $mode = 0) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $userIndex = $_SESSION['userid'];
                $sql = "";
                if (intval($mode) == 1) {
                    $sql = "SELECT * FROM `msgtable` WHERE userIndexFrom = ? AND userIndexTo = ? ORDER BY msgDate DESC LIMIT 1";
                } else {
                    $sql = "SELECT * FROM `msgtable` WHERE userIndexFrom = ? AND userIndexTo = ? ORDER BY msgDate";
                }
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $userIndex, $userIndexTo);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                }
            }
            return $return_arr;
        }

        //the holy grail function : determine suggested recipes based on ingredients selection
        //NOTE: ings must be an array of the ingredients index ONLY, not a multi-dimensional array!!!
        //NOTE: matchedIngsCount is an integer for setting the threshold to how many ingredient match required to pose recipe as a suggested one

        //to use this function for the dashboard, simply fill in the ings with the posted recipes of the current user, 
        //OR, create a separate column for the user's recent search activity, but u know, sa susunod na yon ;)


        //SUBJECT FOR OPTIMIZATION!
        public function getSuggestedRecipes($ings, $matchedIngsCount = 3) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $allRecipes = $this->getAllRecipes_summary();
                //iterate through all recipes
                foreach ($allRecipes as $recipe) {
                    $currentIngs = $this->getIngredients($recipe['recipeIndex']);
                    $cc = 0;
                    //iterate through the input ingredients
                    foreach ($ings as $ing) {
                        //iterate through all ingredients for the current recipe
                        foreach ($currentIngs as $currentIng) {
                            if ($ing == $currentIng['ingIndex']) {
                                if ($cc == $matchedIngsCount) {
                                    //if matched ingredients count is equal to matchedIngsCount threshold, stop everything
                                    $return_arr[] = $recipe;
                                    break 3; //first basic optimization! wag ipilit kung wala namang mangyayari!
                                } else {
                                    $cc = $cc + 1;
                                }
                            }
                        }
                        
                    }
                }
                
            }
            return $return_arr;
        }

    }
?>