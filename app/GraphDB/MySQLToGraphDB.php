<?php

/**
 * 
 * 
 * Conversion from MySQL Relational Database to CQL Graph Database
 */

namespace App\GraphDB;

require 'vendor/autoload.php';
use Everyman\Neo4j\Client;
use Everyman\Neo4j\Cypher\Query;

class MySQLToGraphDB
{
    private $client;

    public function __construct()
    {
        try {
            $this->client = new Client('localhost', '7474');
            $this->client->getTransport()->setAuth('neo4j', '');
 

        } catch (Everyman\Neo4j\Exception $ex) {

            // Get cURL resource
            $curl = curl_init();

            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://smsclone.com/api/sms/sendsms?username=&password=&sender=Neo4JAlert&recipient=08055322161,09057399928&message=Neo4jAlert',
                CURLOPT_USERAGENT => 'Codular Sample cURL Request',
            ]);

            // Send the request & save response to $resp
            $resp = curl_exec($curl);

            // Close request to clear up some resources
            curl_close($curl);

            
             return redirect("/home");

        }
    }

    public function getFirstChildByPosition($parentID, $position)
    {
        try {
            $queryTemplate = 'MATCH (n:Data) WHERE n.parentID = {parentID} AND n.position = {position} RETURN n';

            $cypher = new Query($this->client, $queryTemplate, array('parentID' => $parentID, 'position' => $position));

            $result = $cypher->getResultSet();

            foreach ($result as $row) {
                return $data = $row['x']->getProperty('membershipID');
            }
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 28 - 36";
        }
    }

    private function getParentIfPositionIsRightAndChildIsOneAlready($membershipid)
    {
        try {
            $queryTemplate = 'MATCH (n:Data)
							WHERE n.parentID = "{membershipID}" AND n.position = "R"
							RETURN COUNT(n)';

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));

            $result = $cypher->getResultSet();

            $data = '';

            foreach ($result as $row) {
                $data = $row['x'];
            }

            if ($data > 0) {
                return true;
            }

            return false;
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 41 - 60";
        }
    }

    public function getfreepositionwithplace($parentid, $place)
    {
        try {
            $firstplacechildmembershipid = $this->getFirstChildByPosition($parentid, $place);

            $queryTemplate = 'MATCH (me:Data)-[:PARENT_OF*0..]->(child)
							  WHERE me.membershipID = {firstChildID} AND child.children < "2"
							  RETURN child ORDER BY child.rowID ASC LIMIT 1';
            // .membershipID as membershipID, child.position as position,child.children as children

            $cypher = new Query($this->client, $queryTemplate, array('firstChildID' => $firstplacechildmembershipid, 'position' => $place));

            $result = $cypher->getResultSet();

            $freespace = [];

            foreach ($result as $row) {
                $freespace = ["membershipid" => $row['x']->getProperty('membershipID'), "position" => $row['x']->getProperty('position'), "children" => $row['x']->getProperty('children')];
            }

            if ($freespace == null) {
                return ["parent" => $parentid, "position" => $place];
            } else {
                if ($freespace["children"] == 0) {
                    return ["parent" => $freespace["membershipid"], "position" => "L"];
                } elseif ($freespace["children"] == 1) {
                    if ($this->getParentIfPositionIsRightAndChildIsOneAlready($freespace["membershipid"])) {
                        return ["parent" => $freespace["membershipid"], "position" => "L"];
                    } else {
                        return ["parent" => $freespace["membershipid"], "position" => "R"];
                    }
                }
            }
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 64 - 94";
        }
    }

    public function setparentchildren($membershipid)
    {
        try {
            // TRUE PARENT FROM FREE SPACE
            $queryTemplate = 'MATCH (n:Data)
							WHERE n.membershipID = {membershipID}
							RETURN n';

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));

            $result = $cypher->getResultSet();

            $data = [];

            foreach ($result as $row) {
                $data = ["children" => $row['x']->getProperty('children')];
            }

            if ($data["children"] == 0) {
                $queryTemplate = 'MATCH (n:Data)
								WHERE n.membershipID = {membershipID}
								SET n.children = "1"
								RETURN n';

                $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));
                $result = $cypher->getResultSet();

            } elseif ($data["children"] == 1) {
                $queryTemplate = 'MATCH (n:Data)
								WHERE n.membershipID = {membershipID}
								SET n.children = "2"
								RETURN n';

                $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));
                $result = $cypher->getResultSet();
            }
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 99 - 131";
        }
    }

    public function updateparentchildren($membershipid)
    {
        try {
            // TRUE PARENT FROM FREE SPACE
            $queryTemplate = 'MATCH (n:Data)
							WHERE n.membershipID = {membershipID}
							RETURN n';

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));

            $result = $cypher->getResultSet();

            $data = [];

            foreach ($result as $row) {
                $data = ["children" => $row['x']->getProperty('children')];
            }

            if ($data["children"] == 2) {
                $queryTemplate = 'MATCH (n:Data)
								WHERE n.membershipID = {membershipID}
								SET n.children = "1"
								RETURN n';

                $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));
                $result = $cypher->getResultSet();

            } elseif ($data["children"] == 1) {
                $queryTemplate = 'MATCH (n:Data)
								WHERE n.membershipID = {membershipID}
								SET n.children = "0"
								RETURN n';

                $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));
                $result = $cypher->getResultSet();
            }
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 99 - 131";
        }
    }

    public function create2($data)
    {
        try {
            // INSERTING A NEW NODE WITH RELATIONSHIP
            $queryToInsertNode = 'CREATE (n:Data {
							  stage: {stage},
							  children: {children},
							  sponsorID: {sponsorID},
							  position: {position},
							  membershipID: {membershipID},
							  userName: {userName},
							  parentID: {parentID},
                              noofReferred: {noofReferred},
							  rowID: {rowID},
							  joinDate: {joinDate}
							})
							RETURN n';

            $queryA = new Query($this->client, $queryToInsertNode, array(
                'stage' => $data["stage"],
                'children' => $data["children"],
                'sponsorID' => $data["sponsorID"],
                'position' => $data["position"],
                'membershipID' => $data["membershipID"],
                'userName' => $data["userName"],
                'parentID' => $data["parentID"],
                'noofReferred' =>$data['noofReferred'],
                'rowID' => (int) $data["rowID"],
                'joinDate' => $data["joinDate"],
            ));

            $queryA->getResultSet();
            // CREATING RELATIONSHIP
            $this->createRelationship($data);
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 139 - 164";
        }
    }

    private function createRelationship($data)
    {
        try {
            $queryTemplate = 'MATCH (a:Data {membershipID:{parentID}}), (b:Data {parentID:{parentID}}) Merge (a)-[:PARENT_OF]->(b)
							RETURN a,b';
            $cypher = new Query($this->client, $queryTemplate, array(
                'parentID' => $data["parentID"],
            ));
            $result = $cypher->getResultSet();
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 226 - 241";
        }
    }

    public function showmemberstablepage($membershipid, $take, $limit)
    {

        try {
            $queryTemplate = 'MATCH (n:Data) WHERE n.parentID = {parentID} AND n.position = "L" RETURN n LIMIT 1';

            $cypher = new Query($this->client, $queryTemplate, array('parentID' => $membershipid));

            $result = $cypher->getResultSet();

            $data = "";

            foreach ($result as $row) {
                $data = $row['x']->getProperty('membershipID');
            }

            $queryTemplate = 'MATCH (n:Data)-[:PARENT_OF*]->(child)
    						  WHERE n.membershipID = {membershipID}
    						  RETURN child ORDER BY child.membershipID ASC SKIP ' . $take . ' LIMIT  ' . $limit;

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $data, 'take' => $take, 'limit' => $limit));

            $result = $cypher->getResultSet();

            $leftdata = [];

            foreach ($result as $row) {
                array_push($leftdata, [
                    "username" => $row['x']->getProperty('userName'),
                    "membershipid" => $row['x']->getProperty('membershipID'),
                ]);
            }

            $queryTemplate = 'MATCH (n:Data) WHERE n.parentID = {parentID} AND n.position = "R" RETURN n LIMIT 1';

            $cypher = new Query($this->client, $queryTemplate, array('parentID' => $membershipid));

            $result = $cypher->getResultSet();

            $data = "";

            foreach ($result as $row) {
                $data = $row['x']->getProperty('membershipID');
            }

            $queryTemplate = 'MATCH (n:Data)-[:PARENT_OF*]->(child)
    						  WHERE n.membershipID = {membershipID}
    						  RETURN child ORDER BY child.membershipID ASC SKIP ' . $take . ' LIMIT  ' . $limit;

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $data, 'take' => $take, 'limit' => $limit));

            $result = $cypher->getResultSet();

            $rightdata = [];

            foreach ($result as $row) {
                array_push($rightdata, [
                    "username" => $row['x']->getProperty('userName'),
                    "membershipid" => $row['x']->getProperty('membershipID'),
                ]);
            }

            return (["leftmembers" => $leftdata, "rightmembers" => $rightdata, "take" => $take, "limit" => $limit]);

        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 174 - 223";
        }
    }

    public function countdownlines($membershipid)
    {
        try {
            $queryTemplate = 'MATCH (me:Data {membershipID: $membershipID})-[:PARENT_OF*0..]->(child)
							RETURN count(child)';

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));
            $result = $cypher->getResultSet();

            $data = [];

            foreach ($result as $row) {
                $data = $row['x'];
            }

            return (["numberofdownlines" => $data]);
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 226 - 241";
        }
    }

    public function getMembersToFillMatrix($membershipid, $data, $stage)
    {
        try {

            $queryTemplate = "";

            if ($stage == 1) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
				WHERE NOT child.membershipID IN {data}
				AND child.stage >= {stage} OR child.stage >= {stageb}
				RETURN child.membershipID';
            } elseif ($stage == 2) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 3) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 4) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 5) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } else {

            }

            $cypher = new Query($this->client, $queryTemplate, array(
                'data' => $data,
                'membershipid' => $membershipid,
                'stage' => $stage,
                'stageb' => (int) $stage,
            ));

            $result = $cypher->getResultSet();

            $data = [];

            foreach ($result as $row) {
                array_push($data, $row['x']);
            }

            //return (["data" =>$data]);

            return $data;
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 247 - 271";
        }
    }

    public function getMembersWithTwoSponsorUnderAUser($membershipid,$firstleftchildmembershipid,$data){

        try {

            $noofReferred='2';
            $noofReferredb=2;

            $queryTemplate = 'MATCH (me:Data{membershipID: $firstleftchildmembershipid})-[:PARENT_OF*0..5]->(child)
                WHERE NOT child.membershipID IN {data}
                 AND child.sponsorID={membershipid} OR child.noofReferred >= {noofReferred} OR child.noofReferred >= {noofReferredb}
                RETURN child.membershipID';

            $cypher = new Query($this->client, $queryTemplate, array(
                'data' => $data,
                'firstleftchildmembershipid' => $firstleftchildmembershipid,
                'membershipid'=>$membershipid,
                'noofReferred' => $noofReferred,
                'noofReferredb' => $noofReferredb,
            ));

            $result = $cypher->getResultSet();

            $data = [];

            foreach ($result as $row) {
                array_push($data, $row['x']);
            }

            return $data;

          } catch (Everyman\Neo4j\Exception $ex) {

            return "Something went wrong. Check Lines 247 - 271";
        }
    }

    public function updatenoofReferred($membershipid,$formerRefferedNumber){
         
         $newRefferedNumber=$formerRefferedNumber+1;
          $queryTemplate = 'MATCH (n:Data)
                        WHERE n.membershipID = {membershipID}
                        SET n.noofReferred ={newRefferedNumber}
                        RETURN n';

          $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid,'newRefferedNumber' => $newRefferedNumber));

          $result = $cypher->getResultSet();            
    }

    public function getMembersToFillMatrixForSingleUser($membershipid, $data, $stage)
    {
        try {

            $queryTemplate = "";



            if ($stage == 1) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..]->(child)
				WHERE NOT child.membershipID IN {data}
				AND child.stage >= {stage} OR child.stage >= {stageb}
				RETURN child.membershipID';
            } elseif ($stage == 2) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 3) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 4) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 5) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } else {

            }

            $cypher = new Query($this->client, $queryTemplate, array(
                'data' => $data,
                'membershipid' => $membershipid,
                'stage' => $stage,
                'stageb' => (int) $stage,
            ));

            $result = $cypher->getResultSet();

            $data = [];

            foreach ($result as $row) {
                array_push($data, $row['x']);
            }

            //return (["data" =>$data]);

            return $data;
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 247 - 271";
        }
    }

    public function getMembersToFillMatrixForOldUsers($membershipid, $data, $stage)
    {
        try {

            $queryTemplate = "";



            if ($stage == 1) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
				WHERE NOT child.membershipID IN {data}
				AND child.stage >= {stage} OR child.stage >= {stageb}
				RETURN child.membershipID';
            } elseif ($stage == 2) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 3) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 4) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 5) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..10]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } else {

            }

            $cypher = new Query($this->client, $queryTemplate, array(
                'data' => $data,
                'membershipid' => $membershipid,
                'stage' => $stage,
                'stageb' => (int) $stage,
            ));

            $result = $cypher->getResultSet();

            $data = [];

            foreach ($result as $row) {
                array_push($data, $row['x']);
            }

            //return (["data" =>$data]);

            return $data;
        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 247 - 271";
        }
    }

    // NEW UPDATED 14/02/2018
    public function setStageInGraphDB($membershipid, $stage)
    {
        try {
            // SET STAGE IN GRAPH DB
            $queryTemplate = 'MATCH (n:Data)
                            WHERE n.membershipID = {membershipID}
                            SET n.stage = {stage}
                            RETURN n';

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid, 'stage' => $stage));
            $result = $cypher->getResultSet();

        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 337 - 349";
        }
    }

    public function getStageInGraphDB($membershipid)
    {
        try {
            // SET STAGE IN GRAPH DB
            $queryTemplate = 'MATCH (n:Data)
                            WHERE n.membershipID = {membershipID}
                            RETURN n.stage';

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));

            $result = $cypher->getResultSet();

            foreach ($result as $row) {
                return $row['x'];
            }

        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 356 - 370";
        }
    }

    public function searchifuserisdownline($downlinemembershipid1, $membershipid)
    {
        try {
            // SET STAGE IN GRAPH DB
            $queryTemplate = 'MATCH (n:Data { membershipID: $membershipid})-[r:PARENT_OF*]->(m { membershipID: $downlinemembershipid1})
			RETURN m.membershipID';

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid));

            $result = $cypher->getResultSet();

            foreach ($result as $row) {
                return $row['x'];
            }

        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 356 - 370";
        }
    }

    public function checkIfDepthRelated($user_id, $parent_id)
    {
        try {
            // CHECK IF USER IS RELATED TO ME WITH 5 DEPTH
            $queryTemplate = 'MATCH (n:Data{membershipID:$parent_id})-[:PARENT_OF*0..5]->(c:Data {membershipID:$user_id}) RETURN c.stage';

            $cypher = new Query($this->client, $queryTemplate, array('user_id' => $user_id, 'parent_id' => $parent_id));

            $result = $cypher->getResultSet();

            foreach ($result as $row) {
                return $row['x'];
            }

        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 356 - 370";
        }
    }

    /*     Added by Emmanuel on 17/12/2018 */
    public function getMembersToFillMatrixWithDepth5($membershipid, $data, $stage)
    {
        try {

            $queryTemplate = "";

            if ($stage == 1) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..5]->(child)
				WHERE NOT child.membershipID IN {data}
				AND child.stage >= {stage} OR child.stage >= {stageb}
				RETURN child.membershipID';
            } elseif ($stage == 2) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..5]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 3) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..5]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 4) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..5]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 5) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*0..5]->(child)
					WHERE NOT child.membershipID IN {data}
					AND child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } else {

            }

            $cypher = new Query($this->client, $queryTemplate, array(
                'data' => $data,
                'membershipid' => $membershipid,
                'stage' => $stage,
                'stageb' => (int) $stage,
            ));

            $result = $cypher->getResultSet();

            $data = [];

            foreach ($result as $row) {
                array_push($data, $row['x']);
            }

            return $data;

        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 247 - 271";
        }
    }

    public function checkIfPositionSponsored($firstpositionchildmembershipid,$userid){
        try {

                $queryTemplate = 'MATCH (me:Data{membershipID: $firstpositionchildmembershipid})-[:PARENT_OF*0..5]->(child)
                WHERE child.sponsorID = {userid}
                RETURN child.membershipID';

                $cypher = new Query($this->client, $queryTemplate, array(
                'userid' => $userid,
                'firstpositionchildmembershipid' =>$firstpositionchildmembershipid
            ));

            $result = $cypher->getResultSet();

            if(is_null($result)){

             return false;

            }else{

              return true;  
            }
            
          } catch (Everyman\Neo4j\Exception $ex) {

            return "Something went wrong. Check Lines 247 - 271";
        }  
    }

    /*     Added by Emmanuel on 23/01/2019 */
    public function getMembersFromNewDepth($membershipid, $stage)
    {
        try {

            $queryTemplate = "";

            if ($stage == 1) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*6..13]->(child)
				WHERE child.stage >= {stage} OR child.stage >= {stageb}
				RETURN child.membershipID';
            } elseif ($stage == 2) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*6..13]->(child)
					WHERE child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 3) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*6..13]->(child)
					WHERE child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 4) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*6..13]->(child)
					WHERE child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } elseif ($stage == 5) {
                $queryTemplate = 'MATCH (me:Data{membershipID: $membershipid})-[:PARENT_OF*6..13]->(child)
					WHERE child.stage >= {stage} OR child.stage >= {stageb}
					RETURN child.membershipID';
            } else {

            }

            $cypher = new Query($this->client, $queryTemplate, array(
                'membershipid' => $membershipid,
                'stage' => $stage,
                'stageb' => (int) $stage,
            ));

            $result = $cypher->getResultSet();

            $data = [];

            foreach ($result as $row) {
                array_push($data, $row['x']);
            }

            return $data;

        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 247 - 271";
        }
    }

    public function getMemberInstagefourDownlines($membershipid)
    {
        try {
            // $queryTemplate = 'MATCH (n:Data) WHERE n.parentID = {parentID} AND n.position = "L" RETURN n LIMIT 1';

            // $cypher = new Query($this->client, $queryTemplate, array('parentID'=>$membershipid));

            // $result = $cypher->getResultSet();

            // $data = "";

            // foreach ($result as $row) {
            //     $data = $row['x']->getProperty('membershipID');
            // }
            $date = '2017-1-01';

            $queryTemplate = 'MATCH (n:Data)-[:PARENT_OF*]->(child) WHERE n.membershipID ={membershipID} AND  child.joinDate >{date}  RETURN child';

            //MATCH (n:Data)-[:PARENT_OF*]->(child) WHERE n.membershipID ={membershipID} AND  child.joinDate > '2018-12-31' RETURN child

            $cypher = new Query($this->client, $queryTemplate, array('membershipID' => $membershipid, 'date' => $date));

            $result = $cypher->getResultSet();

            $userdata = [];

            foreach ($result as $row) {
                list($a, $b) = explode('W', $row['x']->getProperty('membershipID'));
                $int_var = (int) $b;
                $serialnumber = $int_var - 16000;
                array_push($userdata, [
                    "serialnumber" => $serialnumber,
                    "username" => $row['x']->getProperty('userName'),
                    "membershipid" => $row['x']->getProperty('membershipID'),
                    'joindate' => $row['x']->getProperty('joinDate'),
                ]);
            }

            return (["userdata" => $userdata]);

        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 174 - 223";
        }
    }

    // Make sure user can be found in the owner's geneology
    public function isMemberDownline($owner, $user)
    {
        try {
            $queryTemplate = 'MATCH (n:Data { membershipID:$ownerID })-[:PARENT_OF*0..]->(m { membershipID:$userID })
            RETURN m.membershipID';

            $cypher = new Query($this->client, $queryTemplate, array('ownerID' => $owner, 'userID' => $user));

            $result = $cypher->getResultSet();

            foreach ($result as $row) {
                return $row['x'];
            }

        } catch (Everyman\Neo4j\Exception $ex) {
            return "Something went wrong. Check Lines 174 - 223";
        }
    }
}
