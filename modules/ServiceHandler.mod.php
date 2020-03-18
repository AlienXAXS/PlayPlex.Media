<?php

	class Metric
	{
		public $date;
		public $status;
		
		function __construct($date, $status)
		{
			$this->date = $date;
			$this->status = $status;
		}
	}

	class Service
	{
		public $id;
		public $name;
		public $path;
		public $pathType;
		public $description;
		public $created;
		public $status;
		
		public $metrics = array();
		
		function __construct($input)
		{
			$this->id = $input['id'];
			$this->name = $input['name'];
			$this->path = $input['path'];
			$this->pathType = $input['pathtype'];
			$this->description = $input['description'];
			$this->created = $input['created'];
		}
		
		function AddMetric($date, $status)
		{
			array_push($this->metrics, new Metric($date, $status));
		}
	}

	class ServiceHandler
	{
		private $config;
		public $services = array();
		
		// Read our database, and load in our services.
		function __construct($config)
		{
			$this->config = $config;
			
			// Load the services from the database
			$this->LoadServices();
		}
		
		private function LoadServices()
		{
			$dbCon = $this->config->GetDatabaseConfig()->databaseConnection;
			$dbCon->orderBy('zorder', 'ASC');
			$services = $dbCon->get('services');
			
			foreach ( $services as $service )
				array_push($this->services, new Service($service));
				
			$this->FillServicesStatusByTimespan($this->config->timespan);
		}
		
		private function GetServiceById($id)
		{
			foreach ( $this->services as $service)
				if ( $service->id == $id ) return $service;
			return null;
		}
		
		// Timespan is in days
		public function FillServicesStatusByTimespan($timespan)
		{
			foreach ( $this->services as $service)
				$this->FillServiceStatusByTimespan($service->id, $timespan);
		}
		
		// Timespan is in days
		public function FillServiceStatusByTimespan($id, $timespan)
		{
			$service = $this->GetServiceById($id);
			if ( !$service ) die("Unknown Service ID " . $id);
			
			$dbCon = $this->config->GetDatabaseConfig()->databaseConnection;			
			$dbCon->where('sid', $id);
			$dbCon->orderBy('created', 'desc');
			$results = $dbCon->get('status', $timespan);
			if ( $results )
			{
				
				$results = array_reverse($results);
				
				// Ensure we always have $timespan days worth of data for the render
				for ($i=1 ; $i <= ($timespan - sizeof($results)) ; $i++)
					$service->AddMetric(null, -1);
				
				foreach ( $results as $result )
					$service->AddMetric($result['created'], $result['metric']);
					
				$service->status = $results[sizeof($results)-1]['metric'];
					
				
			}
		}
	}
	
?>