<?php

$host = "localhost";
$user = "root";
$password = '1997';
$dbname = "database";

//******************************************************* CONNECT

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Successfully connected to database<br>\n<br>\n";
}catch(PDOException $e){
    die("Could not connect to database: " . $e->getMessage() . "<br>\n");
}

//******************************************************* DROP TABLES

$sql1 = "DROP TABLE IF EXISTS orders";
$sql2 = "DROP TABLE IF EXISTS customers";


/* PDO::prepare — Prepares a statement for execution and returns a statement object *//*
 *
 *
 *  @return PDOStatement
 */
$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);


/* PDOStatement::execute — Executes a prepared statement *//*
 *
 * @return boolean
 */
$stmt1->execute();
$stmt2->execute();

//******************************************************* CREATE TABLES

$sql1 = "CREATE TABLE customers(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";

$sql2 = "CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    item VARCHAR(255) NOT NULL,
    price MEDIUMINT UNSIGNED NOT NULL,
    FOREIGN KEY(customer_id) REFERENCES customers(id) ON DELETE CASCADE
)";



$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt1->execute();
$stmt2->execute();


//******************************************************* INSERT

$sql1 = "INSERT INTO customers(name) VALUES('Winona Tingle'),('Taina Foos'),('Charles Mudd'),('Burton Vosburg'),('Jade Conigliaro'),('Tommy Stinnett'),('Dewey Amarante'),('Neville Royston'),('Dewayne Mahurin'),('Isaiah Jablonski'),('Harley Stacy'),('Alvin Room'),('Quentin Hummel'),('Willian Lemley'),('Lance Henriques')";
$sql2 = "INSERT INTO orders(customer_id,item,price) VALUES(1,'Product 231',400),(1,'Product WX1',390),(2,'Product WW1',200),(2,'Product QQ1',300),(3,'Product WW1',200),(3,'Product 222',100),(4,'Product QQ1',300),(5,'Product 22E',200),(6,'Product 222',100),(6,'Product 0A0',450),(7,'Product 3A1',200),(7,'Product 0A0',450),(8,'Product 3A1',200),(8,'Product 2Q9',500),(9,'Product 2Q2',800),(10,'Product 2Q9',500),(11,'Product 2Q2',1600),(11,'Product 9AA',1000),(12,'Product 555',300),(13,'Product D77',400),(13,'Product 9AA',1500),(14,'Product 555',600),(14,'Product 02D',900)";

$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt1->execute();
$stmt2->execute();


//******************************************************* REPLACE

$sql1 = "REPLACE INTO customers VALUES(1,'Rhea Dehaan')";

/* PDO::exec — Execute an SQL statement and return the number of affected rows *//*
 *
 * @returns integer
 */
$conn->exec($sql1); // returns 2 because first deletes then inserts


//******************************************************* UPDATE

$sql1 = "UPDATE customers SET name = 'Winona Foos' WHERE id = :id";
$stmt = $conn->prepare($sql1);
$stmt->execute(array(":id"=>3));



//******************************************************* DELETE

$sql1 = "DELETE FROM orders WHERE id BETWEEN 15 AND 17";
$conn->exec($sql1);



//******************************************************* SELECT

$sql1 = "SELECT item, name FROM orders INNER JOIN customers ON customer_id = customers.id";
$sql2 = "SELECT item,SUM(price) price FROM orders GROUP BY item ORDER BY item;";


/* PDO::query — Executes an SQL statement, returning a result set as a PDOStatement object *//*
 *
 * @param SQLstatement
 *
 * @returns PDOStatement
 */

$stmt1 = $conn->query($sql1);
$stmt2 = $conn->query($sql2);

$stmt1->setFetchMode(PDO::FETCH_ASSOC);
$stmt2->setFetchMode(PDO::FETCH_ASSOC);

echo "ITEM  -------------- NAME <br>\n";
while($row =$stmt1->fetch()){
    echo $row['item'] . " --- " . $row['name'] . "<br>\n";
}


echo "<br>\n<br>\nITEM  -------- TOTAL PRICE <br>\n";
while($row =$stmt2->fetch()){
    echo $row['item'] . " --- " . $row['price'] . "<br>\n";
}


//******************************************************* TRANSACTION


try {

    /* PDO::beginTransaction — Initiates a transaction
     *
     * @returns boolean
     */
    $conn->beginTransaction();

    $sql1 = "DELETE FROM customers WHERE id = :id";
    $sql2 = "UPDATE customers SET name = 'Winona Foos' WHERE id = :id";

    $stmt1 = $conn->prepare($sql1);
    $stmt2 = $conn->prepare($sql2);

    $stmt1->execute(array("id"=>1)); // Delete row with id 5
    $stmt2->execute(array("id"=>1)); // Try to update

    // If no rows were affected by the update, rollback
    if($stmt2->rowCount() == 0){
        $conn->rollBack();
    }else{
        $conn->commit();
    }

}catch(PDOException $e){
    echo $e->getMessage() . "<br>\n";
}
