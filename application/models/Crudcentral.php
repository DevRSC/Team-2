<?php
    //Gil says: "Thou shall not copy others' code as it is their intellectual property."
    //Gil says: "Thou shall not post others' code to Twitter and claim it as your own, as you will induce a lifetime curse of you being an approval seeker and a fake showoff."
    $conn;
	
	
    class Crudcentral extends CI_Model {
        public function __construct() {
            $this->load->library('session');
            global $conn;
            $conn = mysqli_connect("localhost", "[REDACTED LODS]", "[REDACTED LODS]", "mealsformakers");
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

		//generation of random numbers
        public function genrNum($length = 6) {
            $characters = '0123456789';
            $rand = '';
            for ($i = 0; $i < $length; $i++) {
                $rand .= $characters[rand(0, (strlen($characters)) - 1)];
            }
            return $rand;
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
            $sql = "SELECT * FROM usertable WHERE username = ? OR email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $username, $email);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res->num_rows>0) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"Username / Email already exists!"
                );
            } else {
                $sql = "INSERT INTO `usertable`(`userIndex`, `lastname`, `firstname`, `age`, `birthdate`, `email`, `contactnum`, `address`, `profilePic`, `username`, `pword`, `dte`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
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
        public function getLatestUser() {
            global $conn;
            $return_arr = array();
                $sql = "SELECT * FROM usertable ORDER BY dte DESC LIMIT 1";
                $stmt = $conn->prepare($sql);
                
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
            
            return $return_arr;
        }
        
        //get current user profile , and others
        public function getUser($user = "null") {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid']) && $user == "null") {
                //check if a current user is logged in.
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $userIndex = "";
                if (!empty($_SESSION['userid'])) {
                    $userIndex = $_SESSION['userid'];
                }
				
                $sql = "SELECT *, (SELECT COUNT(recipeIndex) FROM recipetable WHERE recipetable.userIndex = usertable.userIndex) AS recipecount, (SELECT COUNT(commIndex) FROM commtable WHERE commtable.userIndex = usertable.userIndex) AS commcount, (SELECT ingtable.ingName FROM ingtable WHERE ingtable.ingIndex = (SELECT recipereftable.ingIndex FROM recipereftable WHERE recipereftable.recipeIndex = (SELECT recipetable.recipeIndex FROM recipetable WHERE recipetable.userIndex = usertable.userIndex LIMIT 1) GROUP BY recipereftable.ingIndex ORDER BY (COUNT(recipereftable.ingIndex)) DESC LIMIT 1)) AS freqing FROM usertable WHERE userIndex = ?";
                //thats a large query boi
                $stmt = $conn->prepare($sql);
                if ($user == "null") {
                    $stmt->bind_param('s', $userIndex);
                } else {
                    $stmt->bind_param('s', $user);
                }
                
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
		//get user by username / email
		public function getUserByNotIndex($user) {
            global $conn;
            $return_arr = array();
                $sql = "SELECT * FROM usertable WHERE username = ? OR email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $user, $user);
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
            
            return $return_arr;
        }
		
		//update user password
		public function updateUserPass($user, $pass) {
            global $conn;
			$mainpass = $this->shaenc($pass);
                $sql = "UPDATE usertable SET pword = ? WHERE userIndex = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $mainpass, $user);
                $stmt->execute();
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
                    $this->session->set_userdata('user',$a['username']);
                    $this->session->set_userdata('userid',$a['userIndex']);
                    $this->session->set_userdata('userfullname',$a['firstname'] . " " . $a['lastname']);
                    $this->session->set_userdata('userfirstname',$a['firstname'] );
                    $this->session->set_userdata('nonce',$this->genr());
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
        public function insertRecipe($title, $desc, $instructions, $img, $vid,
         $doc, $cat, $mode = 1, $recipeIndex = "null") {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                //check if a current user is logged in.
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "SELECT * FROM recipetable WHERE recipeTitle = ? AND isvisible = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $title);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0 && $recipeIndex == "null") {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"Recipe title already exists!"
                    );
                } else {
                    $sql = "";
                    if (intval($mode) == 1) {
                        $sql = "INSERT INTO `recipetable`(`recipeIndex`, `userIndex`, `commIndex`, `recipeTitle`, `recipeDesc`, `recipeInstructions`, `recipeImg`, `recipeVid`, `recipeDoc`, `publishDate`, `modifyDate`, `isvisible`, `cat`) VALUES (?, ?, 'nocommentbruh', ?, ?, ?, ?, ?, ?, now(), now(), 1, ?)";
                    } else {
                        //shhhh
                        $sql34 = "DELETE FROM recipereftable WHERE recipeIndex = ?";
                        $stmt = $conn->prepare($sql34);
                        $stmt->bind_param('s', $recipeIndex);
                        $stmt->execute();
                        $sql = "UPDATE `recipetable` SET `cat` = ? ,`recipeTitle` = ? ,`recipeDesc` = ? ,`recipeInstructions` = ? ,`recipeImg` = ?,`recipeVid` = ?,`recipeDoc` = ?,`modifyDate`=now() WHERE recipeIndex = ?";
                    }
                    $stmt = $conn->prepare($sql);
                    $randIndex = $this->genr();
                    $userIndex = $_SESSION['userid'];
                    if (intval($mode) == 1) {
                        $stmt->bind_param('sssssssss', $randIndex, $userIndex, $title, $desc, $instructions, $img, $vid, $doc, $cat);
                    } else {
                        $stmt->bind_param('ssssssss', $cat, $title, $desc, $instructions, $img, $vid, $doc, $recipeIndex );
                    }
                
                    if ($stmt->execute()) {
                        $return_arr = array(
                            'code'=>"1",
                            'msg'=>"Recipe modification complete!",
                            'recIndex'=>$randIndex,
                            'prevRecIndex'=>$recipeIndex
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
        public function getAllRecipes_summary($cat = "all", $limitation = -1) {
            global $conn;
			
            $return_arr = array();

                $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = recipetable.userIndex) AS recipeauthor, (SELECT COUNT(commIndex) FROM commtable WHERE commtable.recipeIndex = recipetable.recipeIndex) AS commcount FROM recipetable WHERE isvisible = 1 ORDER BY modifyDate DESC";
                if ($cat != "all") {
                    $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = recipetable.userIndex) AS recipeauthor, (SELECT COUNT(commIndex) FROM commtable WHERE commtable.recipeIndex = recipetable.recipeIndex) AS commcount FROM recipetable WHERE isvisible = 1 AND cat = ? ORDER BY modifyDate DESC";
                }
                if (intval($limitation) > 0) {
                    $sql = $sql . " LIMIT " . intval($limitation);
                }
                $stmt = $conn->prepare($sql);
                if ($cat != "all") {
                    $stmt->bind_param('s', $cat);
                }
                
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
                //var_dump($return_arr);
            return $return_arr;
        }

        //get all recipe summary list for the current user, and for others
        public function getAllRecipes_summary_currentUser($user = "null", $limitation = -1) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $usrindex = $_SESSION['userid'];
                $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = recipetable.userIndex) AS recipeauthor, (SELECT COUNT(commIndex) FROM commtable WHERE commtable.recipeIndex = recipetable.recipeIndex) AS commcount FROM recipetable WHERE isvisible = 1 AND userIndex = ? ORDER BY modifyDate DESC";
                if (intval($limitation) > 0) {
                    $sql = $sql . " LIMIT " . intval($limitation);
                }
                $stmt = $conn->prepare($sql);
                if ($user == "null") {
                    $stmt->bind_param('s', $usrindex);
                } else {
                    $stmt->bind_param('s', $user);
                }
                
                
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
                //var_dump($return_arr);
            }
            return $return_arr;
        }

        public function getAllCategories() {
            global $conn;
            $return_arr = array();
                $sql = "SELECT * FROM categorytable";
                $stmt = $conn->prepare($sql);
                
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"No categories?? WHAT?"
                    );
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

        //getting specific recipe by Name
        public function getRecipeByName($recipeName) {
            global $conn;
            $return_arr = array();
            if (empty($_SESSION['userid'])) {
                $return_arr = array(
                    'code'=>"0",
                    'msg'=>"No user is logged in!"
                );
            } else {
                $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = recipetable.userIndex) AS recipeauthor FROM recipetable WHERE recipeTitle = ? AND isvisible = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $recipeName);
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

        //getting random recipe
        public function getRandomRecipe() {
            global $conn;
            $return_arr = array();
                $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = recipetable.userIndex) AS recipeauthor FROM recipetable WHERE isvisible = 1 ORDER BY RAND() LIMIT 1";
                $stmt = $conn->prepare($sql);
               // $stmt->bind_param('s', $recipeName);
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
            
            return $return_arr;
        }

        //getting dashboardCounts
        public function getDashboardCounts() {
            global $conn;
            $return_arr = array();
                $sql = "SELECT (SELECT COUNT(userIndex) FROM usertable) AS usercount, (SELECT COUNT(recipeIndex) FROM recipetable) AS recipecount, (SELECT COUNT(ingIndex) FROM ingtable) AS ingcount, (SELECT COUNT(commIndex) FROM commtable) AS commcount";
                $stmt = $conn->prepare($sql);
                //$stmt->bind_param('s', $recipeName);
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
            
            return $return_arr;
        }

        //getting all ingredients
        public function getAllIngredients($ii) {
            global $conn;
            $return_arr = array();
                $sql = "SELECT * FROM ingtable WHERE ingName LIKE ? GROUP BY ingname";
                $stmt = $conn->prepare($sql);
                $iimod = "%" . $ii . "%";
                $stmt->bind_param('s', $iimod);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"This error should not exist, bruh."
                    );
                }
            
            return $return_arr;
        }

        //getting all ingredients LITERALLY
        public function getAllIngredientsLiterally() {
            global $conn;
            $return_arr = array();
                $sql = "SELECT * FROM ingtable GROUP BY ingname";
                $stmt = $conn->prepare($sql);
                //$iimod = "%" . $ii . "%";
                //$stmt->bind_param('s', $iimod);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $return_arr[] = $a;
                    }
                } else {
                    $return_arr = array(
                        'code'=>"0",
                        'msg'=>"This error should not exist, bruh."
                    );
                }
            
            return $return_arr;
        }

        //inserting comment and rating, as well as update
        //upvoteType 1 = like, otherwise not like
        //rating 1-5
        public function insertComment($recipeIndex, $rating, $comment, $mode = 1) {
            global $conn;
            $return_arr = array();
            $geniusdebug = "a";
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
                
                $geniusdebug = $currentCommIndex;
                if ($mode == 1) {
                    $currentCommIndex = $this->genr();
                    //$geniusdebug = "abc";
                    $sql = "INSERT INTO `commtable`(`commIndex`, `userIndex`, `rating`, `comment`, `recipeIndex`, `dte`) VALUES (?, ?, ?, ?, ?, now())";
                    //$geniusdebug = "abc1";
                    $stmt = $conn->prepare($sql);
                    //$geniusdebug = "abc2 " . $stmt->error;
                    $stmt->bind_param('sssss', $currentCommIndex, $userIndex, $rating, $comment, $recipeIndex);
                    //$geniusdebug = "abc23 " . $stmt->error;
                    if ($stmt->execute()) {
                        //$geniusdebug = "abcd";
                    } else {
                       // $geniusdebug = "abcd eeeeeeeeeeeee";
                        $return_arr = array(
                            'code'=>"0",
                            'msg'=>"Server error! Can't add your comment!"
                        );
                    }
                } else {
                    $sql = "UPDATE `commtable` SET `rating`= ? ,`comment`= ? , `dte` = now() WHERE recipeIndex = ? AND userIndex = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ssss', $rating, $comment, $recipeIndex, $userIndex);
                    if (!$stmt->execute()) {
                        $return_arr = array(
                            'code'=>"0",
                            'msg'=>"Server error! Can't update your rating and comment!"
                        );
                    } else {
                        $geniusdebug = "abd";
                    }
                }
                $return_arr = array(
                    'code'=>"1",
                    'msg'=>"Comment published!",
                    'geniusdebug'=>$geniusdebug
                    
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
                $sql = "SELECT COUNT(upvoteIndex) AS cct FROM upvtable WHERE upvtable.commIndex = ? AND upvoteType = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $commIndex);
                $stmt->execute();
                $res = $stmt->get_result();
                $currCount = 0;
                if ($res->num_rows>0) {
                    while ($a = $res->fetch_assoc()) {
                        $currCount = intval($a['cct']);
                    }
                    $sstat = "disliked";
                    if ($upvExists == 1 && $newUpvoteStat == 1) {
                        $sstat = "liked";
                    } else if ($upvExists == 0) {
                        $sstat = "liked";
                    }
                    $return_arr = array(
                        'code'=>"1",
                        'msg'=>"Upvote succeed!",
                        'upvtype'=>$newUpvoteStat,
                        'upvc'=>$currCount,
                        'sstat'=>$sstat
                    );
                }
                
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
                $usindex = $_SESSION['userid'];
                $sql = "SELECT *, (SELECT upvoteType FROM upvtable WHERE upvtable.commIndex = commtable.commIndex AND upvtable.userIndex = ?) AS upvoteType, (SELECT COUNT(upvoteIndex) FROM upvtable WHERE upvtable.commIndex = commtable.commIndex AND upvoteType = 1) AS upvoteCount, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = commtable.userIndex) AS commentor, (SELECT usertable.profilePic FROM usertable WHERE usertable.userIndex = commtable.userIndex) AS commentorpic FROM `commtable` WHERE recipeIndex = ? ORDER BY (SELECT COUNT(upvoteIndex) FROM upvtable WHERE upvtable.commIndex = commtable.commIndex AND upvoteType = 1) DESC, dte DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $usindex, $recipeIndex);
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
        //mode 2 = read all user messages
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
                    $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = msgtable.userIndexTo ) AS mainname FROM `msgtable` WHERE (userIndexFrom = ? AND userIndexTo = ?) OR (userIndexTo = ? AND userIndexFrom = ?)  ORDER BY msgDate DESC LIMIT 1";
                } else if (intval($mode) == 2) {
                    $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = msgtable.userIndexTo ) AS mainname FROM `msgtable` WHERE userIndexFrom = ? GROUP BY userIndexTo ORDER BY msgDate ";
                } else {
                    $sql = "SELECT *, (SELECT CONCAT(usertable.firstname, ' ', usertable.lastname) FROM usertable WHERE usertable.userIndex = msgtable.userIndexTo ) AS mainname FROM `msgtable` WHERE (userIndexFrom = ? AND userIndexTo = ?) OR (userIndexTo = ? AND userIndexFrom = ?) ORDER BY msgDate ";
                }
                $stmt = $conn->prepare($sql);
                if ((intval($mode) == 2)) {
                    $stmt->bind_param('s', $userIndex);
                } else {
                    $stmt->bind_param('ssss', $userIndex, $userIndexTo, $userIndex, $userIndexTo);
                }
                
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
        public function getSuggestedRecipes($ings, $matchedIngsCount = 2) {
            global $conn;
            $return_arr = array();
                $allRecipes = $this->getAllRecipes_summary();
                //iterate through all recipes
                foreach ($allRecipes as $recipe) {
                    $currentIngs = $this->getIngredients($recipe['recipeIndex']);
                    echo "<br>";
                    $cc = 1;
                    //iterate through the input ingredients
                    foreach ($ings as $ing) {
                        //iterate through all ingredients for the current recipe
                        foreach ($currentIngs as $currentIng) {
                            
                            if ($ing['ingName'] == $currentIng['ingName']) {
                                
                                if ($cc == $matchedIngsCount) {
                                    //if matched ingredients count is equal to matchedIngsCount threshold, stop everything
                                    $return_arr[] = $recipe;
                                    $cc = 1;
                                    break 2; //first basic optimization! wag ipilit kung wala namang mangyayari!
                                } else {
                                    $cc = $cc + 1;
                                }
                            }
                        }
                        
                    }
                }
                
            
            return $return_arr;
        }
		
		public function sendMail($subjectt, $messagee, $too) {
			require('somemail/class.phpmailer.php');
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "smtp.gmail.com"; 
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->Username = "mealsformakersmail@gmail.com";
			$mail->Password = "m34l\$f0rm4k3r\$";
			$mail->From = "mealsformakersmail@gmail.com";
			$mail->FromName = "Meals for Makers Team";
			$mail->setFrom("mealsformakersmail@gmail.com", "Meals for Makers Team");
			
			
			$mail->AddAddress($too, $too);
			
			$mail->WordWrap = 50;
			$mail->IsHTML(true);
			$mail->AddEmbeddedImage("images/ico/logo2.png", "log");
			$mail->Subject = $subjectt;
			
			$message = "<center><img style=\"height: 200px;\" src=\"cid:log\" />" . $messagee . "</center>";

			$mail->Body    = $message;
			$mail->AltBody = $message;

			if(!$mail->Send())
			{
			   echo "Message could not be sent. ";
			   echo "Mailer Error: " . $mail->ErrorInfo;
			   die();
			}
		}

    }
?>