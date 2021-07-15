<?php 

/**
* 
* 31-January-2018
* Conversion from MySQL Relational Database to CQL Graph Database
*/

namespace App\GraphDB;

require('vendor/autoload.php');
use Everyman\Neo4j\Client;
use Everyman\Neo4j\Cypher\Query;

class OLDMySQLToGraphDB
{
	private $client;

	function __construct()
	{
		$this->client = new Client('localhost', '7474');
		$this->client->getTransport()->setAuth('neo4j', 'mlmapptest');
	}

	public function getFirstChildByPosition($parentID, $position)
	{
		try {
			$queryTemplate = 'MATCH (n:Members) WHERE n.parentID = {parentID} AND n.position = {position} RETURN n';
	
			$cypher = new Query($this->client, $queryTemplate, array('parentID'=>$parentID, 'position'=>$position));
	
			$result = $cypher->getResultSet();
	
			foreach ($result as $row) {
				return $data = $row['x']->getProperty('membershipID');
			}
		} catch(Everyman\Neo4j\Exception $ex){
			return "Something went wrong. Check Lines 28 - 36";
		}
	}

	private function getParentIfPositionIsRightAndChildIsOneAlready($membershipid)
	{
		try {
			$queryTemplate = 'MATCH (n:Members)
							WHERE n.parentID = "{membershipID}" AND n.position = "R"
							RETURN COUNT(n)';

			$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));

			$result = $cypher->getResultSet();

			$data = '';

			foreach ($result as $row) {
				$data =  $row['x'];
			}

			if($data > 0){
				return true;
			}

			return false;
		} catch(Everyman\Neo4j\Exception $ex){
			return "Something went wrong. Check Lines 41 - 60";
		}
	}

	public function getfreepositionwithplace($parentid, $place)
	{
		try {
			$firstplacechildmembershipid = $this->getFirstChildByPosition($parentid, $place);

			$queryTemplate = 'MATCH (me:Members)-[:IS_PARENT_OF*0..]->(child)
							  WHERE me.membershipID = {firstChildID} AND child.children < "2"
							  RETURN child ORDER BY id(child) ASC LIMIT 1';
							  
	
			$cypher = new Query($this->client, $queryTemplate, array('firstChildID'=>$firstplacechildmembershipid, 'position'=>$place));
	
			$result = $cypher->getResultSet();	
	
			$freespace = [];
	
			foreach ($result as $row) {
				$freespace = ["parent" => $row['x']->getProperty('parentID'), "membershipid" => $row['x']->getProperty('membershipID'), "position"=>$row['x']->getProperty('position'), "children"=>$row['x']->getProperty('children')];
			}
	
			if ($freespace == null) {
				return ["parent" =>$parentid, "position" =>$place];
			} else {
				if ($freespace["children"] == 0) {
					return ["parent" => $freespace["membershipid"], "position" => "L"];
				}elseif ($freespace["children"] == 1) {
					if($this->getParentIfPositionIsRightAndChildIsOneAlready($freespace["membershipid"])) {
						return ["parent" => $freespace["membershipid"], "position" => "L"];
					}
					else{
						return ["parent" => $freespace["membershipid"], "position" => "R"];
					}
				}
			}
		} catch(Everyman\Neo4j\Exception $ex){
			return "Something went wrong. Check Lines 64 - 94";
		}
	}

	public function setparentchildren($membershipid)
	{
		try {
			// TRUE PARENT FROM FREE SPACE
			$queryTemplate = 'MATCH (n:Members)
							WHERE n.membershipID = {membershipID}
							RETURN n';

			$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));

			$result = $cypher->getResultSet();	

			$data = [];

			foreach ($result as $row) {
				$data = ["children"=>$row['x']->getProperty('children')];
			}

			if ($data["children"] == 0) {
				$queryTemplate = 'MATCH (n:Members)
								WHERE n.membershipID = {membershipID}
								SET n.children = "1"
								RETURN n';

				$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));
				$result = $cypher->getResultSet();

			} elseif ($data["children"] == 1) {
				$queryTemplate = 'MATCH (n:Members)
								WHERE n.membershipID = {membershipID}
								SET n.children = "2"
								RETURN n';

				$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));
				$result = $cypher->getResultSet();
			}
		} catch(Everyman\Neo4j\Exception $ex){
			return "Something went wrong. Check Lines 99 - 131";
		}
	}

	public function updateparentchildren($membershipid)
	{
		try {
			// TRUE PARENT FROM FREE SPACE
			$queryTemplate = 'MATCH (n:Members)
							WHERE n.membershipID = {membershipID}
							RETURN n';

			$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));

			$result = $cypher->getResultSet();	

			$data = [];

			foreach ($result as $row) {
				$data = ["children"=>$row['x']->getProperty('children')];
			}

			if ($data["children"] == 2) {
				$queryTemplate = 'MATCH (n:Members)
								WHERE n.membershipID = {membershipID}
								SET n.children = "1"
								RETURN n';

				$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));
				$result = $cypher->getResultSet();

			} elseif ($data["children"] == 1) {
				$queryTemplate = 'MATCH (n:Members)
								WHERE n.membershipID = {membershipID}
								SET n.children = "0"
								RETURN n';

				$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));
				$result = $cypher->getResultSet();
			}
		} catch(Everyman\Neo4j\Exception $ex){
			return "Something went wrong. Check Lines 99 - 131";
		}
	}


	public function create2($data)
	{
		try {
		// INSERTING A NEW NODE WITH RELATIONSHIP
		$queryToInsertNode = 'CREATE (n:Members {
							  stage: {stage},
							  children: {children},
							  sponsorID: {sponsorID},
							  position: {position},
							  membershipID: {membershipID},
							  userName: {userName},
							  parentID: {parentID}
							})
							RETURN n';
		
		$queryA = new Query($this->client, $queryToInsertNode, array(
                                        'stage'=>$data["stage"],
										'children'=>$data["children"],
										'sponsorID'=>$data["sponsorID"],
										'position'=>$data["position"],
										'membershipID'=>$data["membershipID"],
										'userName'=>$data["userName"],
										'parentID'=>$data["parentID"]
															));

		$queryA->getResultSet();
		// CREATING RELATIONSHIP
		$this->createRelationship($data);
		} catch(Everyman\Neo4j\Exception $ex) {
			return "Something went wrong. Check Lines 139 - 164";
		}
	}

	private function createRelationship($data)
	{
		try {
			$queryTemplate =  'MATCH (a:Members {membershipID:{parentID}}), (b:Members {parentID:{parentID}}) Merge (a)-[:IS_PARENT_OF]->(b)
							RETURN a,b';
			$cypher = new Query($this->client, $queryTemplate, array(
																	'parentID'=>$data["parentID"]
																	));
			$result = $cypher->getResultSet();	
		} catch(Everyman\Neo4j\Exception $ex) {
			return "Something went wrong. Check Lines 226 - 241";
		}
	}

	public function showmemberstablepage($membershipid)
	{
		try {
    		$queryTemplate = 'MATCH (n:Members) WHERE n.parentID = {parentID} AND n.position = "L" RETURN n LIMIT 1';
    	
    		$cypher = new Query($this->client, $queryTemplate, array('parentID'=>$membershipid));
    
    		$result = $cypher->getResultSet();
    
    		$data = "";
    
    		foreach ($result as $row) {
    		    $data = $row['x']->getProperty('membershipID');
    		}
    
    		$queryTemplate = 'MATCH (me:Members), (child)
    						WHERE (me)-[:IS_PARENT_OF*0..]->(child)
    						and me.membershipID = {membershipID}
    						RETURN child LIMIT 10';
    
    		$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$data));
    		$result = $cypher->getResultSet();
    
    		$leftdata = [];
    
    		foreach ($result as $row) {
    			array_push($leftdata, [
    				// "parentid" => $row['x']->getProperty('parentID'),
    				// "sponsorid" => $row['x']->getProperty('sponsorID'),
    				"username" => $row['x']->getProperty('userName'),
    				"membershipid" => $row['x']->getProperty('membershipID')
    				// "position"=>$row['x']->getProperty('position'),
    				// "children"=>$row['x']->getProperty('children')
    			]);
    		}
    
    
    		$queryTemplate = 'MATCH (n:Members) WHERE n.parentID = {parentID} AND n.position = "R" RETURN n LIMIT 1';
    	
    		$cypher = new Query($this->client, $queryTemplate, array('parentID'=>$membershipid));
    
    		$result = $cypher->getResultSet();
    
    		$data = "";
    
    		foreach ($result as $row) {
    		    $data = $row['x']->getProperty('membershipID');
    		}
    
    		$queryTemplate = 'MATCH (me:Members), (child)
    						WHERE (me)-[:IS_PARENT_OF*0..]->(child)
    						and me.membershipID = {membershipID}
    						RETURN child LIMIT 10';
    
    		$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$data));
    
    		$result = $cypher->getResultSet();
    		
    		$rightdata = [];
    
    		foreach ($result as $row) {
    			array_push($rightdata, [
    				// "parentid" => $row['x']->getProperty('parentID'),
    				// "sponsorid" => $row['x']->getProperty('sponsorID'),
    				"username" => $row['x']->getProperty('userName'),
    				"membershipid" => $row['x']->getProperty('membershipID')
    				// "position"=>$row['x']->getProperty('position'),
    				// "children"=>$row['x']->getProperty('children')
    			]);
    		}
    
    		return (["leftmembers" =>$leftdata, "rightmembers" => $rightdata]);
		
		}catch(Everyman\Neo4j\Exception $ex) {
			return "Something went wrong. Check Lines 174 - 223";
		}
	}

	function countdownlines($membershipid)
	{
		try {
			$queryTemplate = 'MATCH (me:Members {membershipID: $membershipID})-[:IS_PARENT_OF*0..]->(child)
							RETURN count(child)';

			$cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));
			$result = $cypher->getResultSet();
			
			$data = [];

			foreach ($result as $row) {
				$data = $row['x'];
			}

			return (["numberofdownlines" => $data]);	
		}catch(Everyman\Neo4j\Exception $ex) {
			return "Something went wrong. Check Lines 226 - 241";
		}
	}


	//print_r(fillmatrix2('HW00018001', ["HW00018001","HW00018002","HW00018003","HW00018008","HW00018009","HW00018010","HW00018011","HW00018012","HW00018013","HW00018014","HW00018017","HW00018018","W00018019"], '1'));

    function getMembersToFillMatrix($membershipid, $data, $stage)
    {
		try {
		    
		    $queryTemplate = "";
		    
			// TRUE PARENT FROM FREE SPACE

			if ($stage == 1) {
				$queryTemplate = 'MATCH (me:Members{membershipID: $membershipid})-[:IS_PARENT_OF*0..40]->(child)
				WHERE NOT child.membershipID IN {data}
				AND child.stage >= {stage} OR child.stage >= {stageb}
				RETURN child.membershipID';	
			}elseif ($stage == 2) {
				$queryTemplate = 'MATCH (me:Members{membershipID: $membershipid})-[:IS_PARENT_OF*0..30]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';	
			}elseif ($stage == 3) {
				$queryTemplate = 'MATCH (me:Members{membershipID: $membershipid})-[:IS_PARENT_OF*0..30]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';	
			}elseif ($stage == 4) {
				$queryTemplate = 'MATCH (me:Members{membershipID: $membershipid})-[:IS_PARENT_OF*0..15]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';	
			}elseif ($stage == 5) {
				$queryTemplate = 'MATCH (me:Members{membershipID: $membershipid})-[:IS_PARENT_OF*0..7]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';	
			}else {
				
			}

			$cypher = new Query($this->client, $queryTemplate, array(
																		'data' => $data, 
																		'membershipid' => $membershipid, 
																		'stage' => $stage,
																		'stageb' => (int)$stage,
																	));
			
			$result = $cypher->getResultSet();	
			
			$data = [];

			foreach ($result as $row) {
				array_push($data, $row['x']);
			}

			//return (["data" =>$data]);

			return $data;
		}catch(Everyman\Neo4j\Exception $ex) {
			return "Something went wrong. Check Lines 247 - 271";
		}
    }
    
    // NEW UPDATED 14/02/2018
    public function setStageInGraphDB($membershipid, $stage)
    {
        try {
            // SET STAGE IN GRAPH DB
            $queryTemplate = 'MATCH (n:Members)
                            WHERE n.membershipID = {membershipID}
                            SET n.stage = {stage}
                            RETURN n';
    
            $cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid, 'stage'=>$stage));
            $result = $cypher->getResultSet();
    
        } catch(Everyman\Neo4j\Exception $ex){
            return "Something went wrong. Check Lines 337 - 349";
        }
    }
    
    public function getStageInGraphDB($membershipid)
    {
        try {
            // SET STAGE IN GRAPH DB
            $queryTemplate = 'MATCH (n:Members)
                            WHERE n.membershipID = {membershipID}
                            RETURN n.stage';
    
            $cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));
    
            $result = $cypher->getResultSet();
    	
            foreach ($result as $row) {
                return $row['x'];
            }
    
        } catch(Everyman\Neo4j\Exception $ex){
            return "Something went wrong. Check Lines 356 - 370";
        }
	}
	
	public function searchifuserisdownline($downlinemembershipid1, $membershipid)
	{
        try {
            // SET STAGE IN GRAPH DB
            $queryTemplate = 'MATCH (n:Members { membershipID: $membershipid})-[r:IS_PARENT_OF*]->(m { membershipID: $downlinemembershipid1})
			RETURN m.membershipID';
    
            $cypher = new Query($this->client, $queryTemplate, array('membershipID'=>$membershipid));
    
            $result = $cypher->getResultSet();
    	
            foreach ($result as $row) {
                return $row['x'];
            }
    
        } catch(Everyman\Neo4j\Exception $ex){
            return "Something went wrong. Check Lines 356 - 370";
		}
	}
}