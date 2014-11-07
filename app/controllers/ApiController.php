<?php

class ApiController extends Controller {
	public function index()
	{
		return 'Hello, to BJS API!';
	}

	public function show( $id = null ) {
		return Response::json(TransactionQuery::getEmployeeCurrentSalary( $id ));
	}

	public function store( ) {
		return Response::json(TransactionQuery::addEmployee( ));
	}
}
