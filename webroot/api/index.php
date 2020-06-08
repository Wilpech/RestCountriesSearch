<?php

    $function=$_REQUEST["function"];
    $function();
    
    function searchAPI() {
    
    $input = $_REQUEST["input"];
    
    //determines which type of search we will perform
    if($input != "" && (strlen($input) > 3)) {
        $response = file_get_contents('https://restcountries.eu/rest/v2/name/'.$input.'?fields=name;alpha2Code;alpha3Code;flag;region;subregion;population;languages');
    }
    else if ($input != "" && (strlen($input) <= 3)) {
        $response = file_get_contents('https://restcountries.eu/rest/v2/alpha/'.$input.'fields=name;alpha2Code;alpha3Code;flag;region;subregion;population;languages');
    }
    
    else if ($input == "" || $input == null){
        echo "Your search has produced no results, please try again.";
    }
    
    //responses decoded & sorted
    $response = json_decode($response);
    $response = arsort($response);
    
    //table header construction
    if($response != "" && $response!=null) {
          echo "<table>";
            echo "<tr>";
                echo "<th>Country Name</th>";
                echo "<th>Alpha Code 2</th>";
                echo "<th>Alpha Code 3</th>";
                echo "<th>Flag</th>";
                echo "<th>Region</th>";
                echo "<th>Subregion</th>";
                echo "<th>Population</th>";
                echo "<th>Language List</th>";
                echo "</tr>";
            
            //count returned results on table
            $totalCountries = count($response);
            
            //creating & populating the table to return to the front-end
            for ($i = 0; $i < $totalCountries; $i++) {
                echo "<tr>";
                    echo"<td>" . $response[$i]->name . "</td>";
                    echo"<td>" . $response[$i]->alpha2Code . "</td>";
                    echo"<td>" . $response[$i]->alpha3Code . "</td>";
                    echo"<td><img src='" . $response[$i]->flag . "'</td";
                    echo"<td>" . $response[$i]->region . "</td>";
                    echo"<td>" . $response[$i]->subregion . "</td>";
                    echo"<td>" . number_format($response[$i]->population) . "</td>";
                    echo"<td>";
                        
                    for ($j = 0; $j < count($response[i]->languages); $j++) {
                        if(count($response[$i]->languages) > 1) {
                            echo $response[$i]->languages[$k]->name;
                        }
                        else {
                            echo $response[$i]->languages[$k]->name;
                        }
                    }
               echo "</td>";
            echo"</tr>";
            }
            echo "</table>";
            
            //creates footer display, showing Total # of Countries, Regions & Sub-Regions
            echo "<h3>Total number of countries:" . count($response) . "</h3>";
            echo "<h3> Regions: </h3>";
            
            //counting the regions & displaying them
            echo "<ul>";
            $regionResults = [];
            foreach ($response as &$region) {
                array_push($regionResults,$region->region);
            }
            
            $totalRegions = array_count_values($regionResults);
            foreach($totalRegions as $key => $value) {
                if ($key != null || $key != "") {
                    echo "<li>" . $key . " (" . $alue. ")</li>";
                }
            }
           echo "</ul>";
           
           echo "<h3>Subregions: </h3>";
           echo "<ul>";
            $subregionResults = [];
            foreach($response as &$subregion) {
                array_push($subregionResults,$subregion->subregion);
            }
            
            $subregionTotals = array_count_values($subregionResults);
            
            foreach ($subregionTotals as $key => $value) {
                if ($key != null || $key != "") {
                    echo "<li>" . $key . " (" . $value . ")</li>";
                }
            }
          echo "</ul>";
        }
      }
   ?> 