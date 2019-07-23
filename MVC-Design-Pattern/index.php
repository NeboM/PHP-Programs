<?php

class Student{
	private $studentID;
	private $studentName;

	public function getStudentID() : int {
		return $this->studentID;
	}
	public function getStudentName() : string {
		return $this->studentName;
	}
	public function setStudentID(int $id) : void {
		$this->studentID = $id;
	}
	public function setStudentName(string $studentName) : void {
		$this->studentName = $studentName;
	}
	
}

class StudentView {
	public function printStudentDetails(int $id, string $name) : void {
		echo "Student - " . $id . " - " . $name . "<br>";
	}
}

class StudentController{
	private $model;
	private $view;

	public function __construct(Student $model, StudentView $view){
		$this->model = $model;
		$this->view = $view;
	}

	public function setStudentID(int $id) : void {
		$this->model->setStudentID = $id;
	}
	public function setStudentName(string $studentName) : void {
			$this->model->setStudentName = $studentName;
	}	
	public function getStudentID() : int {
		return $this->model->getStudentID();
	}
	public function getStudentName() : string{
		return $this->model->getStudentName();
	}

	public function view() : void {
		$this->view->printStudentDetails($this->model->getStudentID(), $this->model->getStudentName());
	}

}

class Database{
	public function getStudentFromDatabase() : Student{
		$student = new Student();
		$student->setStudentID(173238);
		$student->setStudentName("Nebojsha Mitikj");
		return $student;
	}
}


$db = new Database();
$model  = $db->getStudentFromDatabase();
$view = new StudentView();
$studentController = new StudentController($model,$view);
$studentController->view();

