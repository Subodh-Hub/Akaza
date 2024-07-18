<?php 


    class Database{
        public $servername="localhost";
        public $username="root";
        public $password="";
        public $database="Akaza";
        public $connection;

        function __construct(){
            $this->connection=new mysqli($this->servername,$this->username,$this->password,$this->database);
            
            if($this->connection->connect_error){
                echo $this->connection->connect_error;
            }else{
                echo "<script> console.log('database connected successfully')</script>";
            }
        }

        function check_user($username, $password){
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = $this->connection->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_array();
                return $row['username'];
            } else {
                echo "<script>alert('Invalid Input')</script>";
                return false;
            }
        }

        function register_user($username, $email, $password) {
            $password = md5($password);
            $existingUserQuery = "SELECT * FROM users WHERE username = '$username'";
            $existingUserResult = $this->connection->query($existingUserQuery);
        
            if ($existingUserResult->num_rows > 0) {
                echo "<script>alert('Error: Username already exists')</script>";
                return false;
            }
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        
            if ($this->connection->query($query) === true) {
                echo "<script> console.log('User registered successfully')</script>";
                return true;
            } else {
                echo "Error: " . $query . "<br>" . $this->connection->error;
                return false;
            }
        }
        
       
        
        public function get_anime_list_by_search($search_query) {
            // Perform database query to fetch anime data based on the search query
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("SELECT * FROM anime_list WHERE title LIKE ?");
            $search_query = "%$search_query%"; // Add '%' to search for partial matches
            $stmt->bind_param("s", $search_query);
            $stmt->execute();
            $result = $stmt->get_result();
            $anime_data = $result->fetch_all(MYSQLI_ASSOC);
            return $anime_data;
        }

        

        function get_anime_list(){
            $query = "SELECT * FROM anime_list ORDER BY vid_id DESC";
            $result = $this->connection->query($query);
            $anime_data = [];

            while ($row = mysqli_fetch_array($result)) {
                $anime_data[] = $row;
            }

            return $anime_data;
        }


        public function get_anime_list_by_genre($genre) {
            
            if($genre == "All"){
                $query = "SELECT * FROM anime_list ORDER BY vid_id DESC";
                $result = $this->connection->query($query);
                $anime_data = [];

                while ($row = mysqli_fetch_array($result)) {
                    $anime_data[] = $row;
                }

                return $anime_data;
            }
            else{
                $sql = "SELECT * FROM anime_list WHERE genre = ? ORDER BY vid_id DESC";
                $stmt = $this->connection->prepare($sql);
                $stmt->bind_param("s", $genre);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }

            
        }

        public function incrementAnimeViews($vid_id) {
            // Prepare and execute SQL query to increment views by 1 based on vid_id
            $sql = "UPDATE anime_list SET views = views + 1 WHERE vid_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("i", $vid_id);
            $stmt->execute();
            $stmt->close();
        }
        

        public function getTopAnime() {
            // Prepare and execute SQL query to get top 5 anime videos based on views
            $sql = "SELECT vid_id, title, banner_loc FROM anime_list ORDER BY views DESC LIMIT 5";
            $result = $this->connection->query($sql);
    
            $top_anime = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $top_anime[] = $row;
                }
            }
    
            return $top_anime;
        }

        function get_anime_info($id){
            $query = "SELECT * FROM anime_list WHERE vid_id='$id'";
            $result = $this->connection->query($query);
            

            while ($row = mysqli_fetch_array($result)) {
                return $row;
            }

        }



    }
?>