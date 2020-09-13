<?php

    /**
     * @author Varun Kumar <varunon9@gmail.com>
     */
    
    require_once('Category.php');


    class NaiveBayesClassifier {

    	public function __construct() {
    	}

        /**
         * sentence is text(document) which will be classified as ham or spam
         * @return category- ham/spam
         */
    	public function classify($sentence) {

    		// extracting keywords from input text/sentence
    		$keywordsArray = $this -> tokenize($sentence);

    		// classifying the category
    		$category = $this -> decide($keywordsArray);

    		return $category;
    	}

    	/**
    	 * @sentence- text/document provided by user as training data
    	 * @category- category of sentence
    	 * this function will save sentence aka text/document in trainingSet table with given category
    	 * It will also update count of words (or insert new) in wordFrequency table
    	 */
    	public function train($sentence, $category) {
    		$murder = Category::$Murder;
            $pp = Category::$PP;
            $vt = Category::$VT;
            $rr = Category::$RR;
            $cc = Category::$CC;
            $et = Category::$ET;

    		if ($category == $murder || $category == $pp || $category == $vt || $category == $rr || $category == $cc || $category == $et) {
            
	            //connecting to database
	    	    require 'db_connect.php';

	    	    // inserting sentence into trainingSet with given category
	    	    $sql = mysqli_query($conn, "INSERT into trainingSet (document, category) values('$sentence', '$category')");

	    	    // extracting keywords
	    	    $keywordsArray = $this -> tokenize($sentence);

	    	    // updating wordFrequency table
	    	    foreach ($keywordsArray as $word) {

	    	    	// if this word is already present with given category then update count else insert
	    	    	$sql = mysqli_query($conn, "SELECT count(*) as total FROM wordFrequency WHERE word = '$word' and category= '$category' ");
	    	    	$count = mysqli_fetch_assoc($sql);

	    	    	if ($count['total'] == 0) {
	    	    		$sql = mysqli_query($conn, "INSERT into wordFrequency (word, category, count) values('$word', '$category', 1)");
	    	    	} else {
	    	    		$sql = mysqli_query($conn, "UPDATE wordFrequency set count = count + 1 where word = '$word'");
	    	    	}
	    	    }

	    	    //closing connection
	    	    $conn -> close();

    		} else {
    			throw new Exception('Unknown category. Valid categories are: $murder, $pp, $vt, $cc, $et, $rr');
    		}
    	}

    	/**
    	 * this function takes a paragraph of text as input and returns an array of keywords.
    	 */

    	private function tokenize($sentence) {
	        $stopWords = array('about','and','are','com','for','from','how',
	            'that','the','this', 'was','what','when','where','who','will','with','und','the','www');

	    	//removing all the characters which ar not letters, numbers or space
	    	$sentence = preg_replace("/[^a-zA-Z 0-9]+/", "", $sentence);

	    	//converting to lowercase
	    	$sentence = strtolower($sentence);

	        //an empty array
	    	$keywordsArray = array();

	    	//splitting text into array of keywords
	        //http://www.w3schools.com/php/func_string_strtok.asp
	    	$token =  strtok($sentence, " ");
	    	while ($token !== false) {

	    		//excluding elements of length less than 3
	    		if (!(strlen($token) <= 2)) {

	    			//excluding elements which are present in stopWords array
	                //http://www.w3schools.com/php/func_array_in_array.asp
	    			if (!(in_array($token, $stopWords))) {
	    				array_push($keywordsArray, $token);
	    			}
	    		}
		    	$token = strtok(" ");
	    	}
	    	return $keywordsArray;
    	}

   
    	private function decide ($keywordsArray) {
    		$murder = Category::$Murder;
            $pp = Category::$PP;
            $vt = Category::$VT;
            $rr = Category::$RR;
            $cc = Category::$CC;
            $et = Category::$ET;

            // by default assuming category to be ham
    		$category = $pp;

    		// making connection to database
    	    require 'db_connect.php';

    		$sql = mysqli_query($conn, "SELECT count(*) as total FROM trainingSet WHERE  category = '$pp' ");
    		$spamCount = mysqli_fetch_assoc($sql);
    		$spamCount = $spamCount['total'];

    		$sql = mysqli_query($conn, "SELECT count(*) as total FROM trainingSet WHERE  category = '$murder' ");
    		$hamCount = mysqli_fetch_assoc($sql);
    		$hamCount = $hamCount['total'];

            $sql = mysqli_query($conn, "SELECT count(*) as total FROM trainingSet WHERE  category = '$cc' ");
            $ccCount = mysqli_fetch_assoc($sql);
            $ccCount = $ccCount['total'];

            $sql = mysqli_query($conn, "SELECT count(*) as total FROM trainingSet WHERE  category = '$rr' ");
            $rrCount = mysqli_fetch_assoc($sql);
            $rrCount = $rrCount['total'];

            $sql = mysqli_query($conn, "SELECT count(*) as total FROM trainingSet WHERE  category = '$et' ");
            $etCount = mysqli_fetch_assoc($sql);
            $etCount = $etCount['total'];

            $sql = mysqli_query($conn, "SELECT count(*) as total FROM trainingSet WHERE  category = '$vt' ");
            $vtCount = mysqli_fetch_assoc($sql);
            $vtCount = $vtCount['total'];

    		$sql = mysqli_query($conn, "SELECT count(*) as total FROM trainingSet ");
    		$totalCount = mysqli_fetch_assoc($sql);
    		$totalCount = $totalCount['total'];

    		//p(spam) pick pocketing
    		$pSpam = $spamCount / $totalCount; // (no of documents classified as spam / total no of documents)

    		//p(ham) Murder
    		$pHam = $hamCount / $totalCount; // (no of documents classified as ham / total no of documents)
    		
            $pcc = $ccCount / $totalCount;

            $prr = $rrCount / $totalCount;

            $pet = $etCount / $totalCount;

            $pvt = $vtCount / $totalCount;
    		//echo $pSpam." ".$pHam;
            
            // no of distinct words (used for laplace smoothing)
            $sql = mysqli_query($conn, "SELECT count(*) as total FROM wordFrequency ");
    		$distinctWords = mysqli_fetch_assoc($sql);
    		$distinctWords = $distinctWords['total'];

    		$bodyTextIsSpam = log($pSpam);
    		foreach ($keywordsArray as $word) {
    			$sql = mysqli_query($conn, "SELECT count as total FROM wordFrequency where word = '$word' and category = '$pp' ");
    			$wordCount = mysqli_fetch_assoc($sql);
    			$wordCount = $wordCount['total'];
    			$bodyTextIsSpam += log(($wordCount + 1) / ($spamCount + $distinctWords));
    		}

    		$bodyTextIsHam = log($pHam);
    		foreach ($keywordsArray as $word) {
    			$sql = mysqli_query($conn, "SELECT count as total FROM wordFrequency where word = '$word' and category = '$murder' ");
    			$wordCount = mysqli_fetch_assoc($sql);
    			$wordCount = $wordCount['total'];
    			$bodyTextIsHam += log(($wordCount + 1) / ($hamCount + $distinctWords));
    		}

            $bodyTextIscc = log($pcc);
            foreach ($keywordsArray as $word) {
                $sql = mysqli_query($conn, "SELECT count as total FROM wordFrequency where word = '$word' and category = '$cc' ");
                $wordCount = mysqli_fetch_assoc($sql);
                $wordCount = $wordCount['total'];
                $bodyTextIscc += log(($wordCount + 1) / ($ccCount + $distinctWords));
            }

            $bodyTextIsrr = log($prr);
            foreach ($keywordsArray as $word) {
                $sql = mysqli_query($conn, "SELECT count as total FROM wordFrequency where word = '$word' and category = '$rr' ");
                $wordCount = mysqli_fetch_assoc($sql);
                $wordCount = $wordCount['total'];
                $bodyTextIsrr += log(($wordCount + 1) / ($rrCount + $distinctWords));
            }

            $bodyTextIset = log($pet);
            foreach ($keywordsArray as $word) {
                $sql = mysqli_query($conn, "SELECT count as total FROM wordFrequency where word = '$word' and category = '$et' ");
                $wordCount = mysqli_fetch_assoc($sql);
                $wordCount = $wordCount['total'];
                $bodyTextIset += log(($wordCount + 1) / ($etCount + $distinctWords));
            }

            $bodyTextIsvt = log($pvt);
            foreach ($keywordsArray as $word) {
                $sql = mysqli_query($conn, "SELECT count as total FROM wordFrequency where word = '$word' and category = '$vt' ");
                $wordCount = mysqli_fetch_assoc($sql);
                $wordCount = $wordCount['total'];
                $bodyTextIsvt += log(($wordCount + 1) / ($vtCount + $distinctWords));
            }

    		if ($bodyTextIsHam >= $bodyTextIsSpam && $bodyTextIsHam >= $bodyTextIscc && $bodyTextIsHam >= $bodyTextIsrr && $bodyTextIsHam >= $bodyTextIsvt && $bodyTextIsHam >= $bodyTextIset) {
    			$category = $murder;
    		} else if ($bodyTextIsSpam >= $bodyTextIsHam && $bodyTextIsSpam >= $bodyTextIscc && $bodyTextIsSpam >= $bodyTextIsrr && $bodyTextIsSpam >= $bodyTextIsvt && $bodyTextIsSpam >= $bodyTextIset){
    			$category = $pp;
    		}
            else if ($bodyTextIscc >= $bodyTextIsHam && $bodyTextIscc >= $bodyTextIsSpam && $bodyTextIscc >= $bodyTextIsrr && $bodyTextIscc >= $bodyTextIsvt && $bodyTextIscc >= $bodyTextIset){
                $category = $cc;
            }
             else if ($bodyTextIsrr >= $bodyTextIsHam && $bodyTextIsrr >= $bodyTextIsSpam && $bodyTextIsrr >= $bodyTextIscc && $bodyTextIsrr >= $bodyTextIsvt && $bodyTextIsrr >= $bodyTextIset){
                $category = $rr;
            }
            else if ($bodyTextIset >= $bodyTextIsHam && $bodyTextIset >= $bodyTextIsSpam && $bodyTextIset >= $bodyTextIscc && $bodyTextIset >= $bodyTextIsvt && $bodyTextIset >= $bodyTextIsrr){
                $category = $et;
            }
            else if ($bodyTextIsvt >= $bodyTextIsHam && $bodyTextIsvt >= $bodyTextIsSpam && $bodyTextIsvt >= $bodyTextIscc && $bodyTextIsvt >= $bodyTextIset && $bodyTextIsvt >= $bodyTextIsrr){
                $category = $vt;
            }

    		$conn -> close();

    		return $category;
    	}
    }

?>
