<?php
            include("../DB/config.php");

            if ( (isset($_GET["page"])) && (isset($_GET["limit"]))) {
            	$page = $_GET["page"];
            	$limit = $_GET["limit"];

            }

            else {
            	$page = 0;
            	$limit = 30;
            }

            $sql = "SELECT id, nomeC, cognomeC, codC, descrC, noteC, indirizzoLC, cittaLC, capLC, provLC, telLC, faxLC, statoLC, emailLC, urlLC, indirizzoAC, cittaAC, capAC, provAC, telAC, cellAC, statoAC, emailAC,urlAC, PIVAC, CFC, IBANC, bancaC FROM clienti LIMIT ".$limit." OFFSET ".$page;
            $result = mysqli_query($conndb, $sql);
            $results = array();
            $key = 0;

            while ($row = mysqli_fetch_array($result)) {

                array_push($row, $key);
                array_push($results, $row);
                $key++;
            }


           echo json_encode($results, JSON_HEX_QUOT | JSON_PRETTY_PRINT );
