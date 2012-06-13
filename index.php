<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Beautiful Publications From BibTeX</title>
	<script type="text/javascript" src="js/jquery.min.js"></script> 
    <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="js/jquery.tipsy.js"></script> 
    <script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>   
    <script type="text/javascript" src="js/custom.js"></script>
    <link rel="stylesheet" type="text/css" href="css/custom.css"/>
    <link rel="stylesheet" type="text/css" href="css/tipsy.css"/>
    <link rel="stylesheet" type="text/css" href="css/fancybox.css"/>
</head>
<body>
  <div class="publications"> 
    <h3 class="main-heading"><span>Publications</span></h3>
    <ul id="publication-filter">
      <li><a href="#" class="current" data-filter="*">All</a></li>
      <li><a href="#" data-filter=".2012">2012</a></li>
      <li><a href="#" data-filter=".2011">2011</a></li>
      <li><a href="#" data-filter=".2010">2010</a></li>
      <li><a href="#" data-filter=".2009">2009</a></li>
      <li><a href="#" data-filter=".2008">2008</a></li>
      <li><a href="#" data-filter=".2007">2007</a></li>
      <li><a href="#" data-filter=".2006">2006</a></li>
      <li><a href="#" data-filter=".2005">2005</a></li>
      <li><a href="#" data-filter=".2004">2004</a></li>
      <li><a href="#" data-filter=".2003">2003</a></li>
      <li><a href="#" data-filter=".2002">2002</a></li>
      <li><a href="#" data-filter=".2001">2001</a></li>
      <li><a href="#" data-filter=".2000">2000</a></li>
    </ul>
    <div style="clear:both;"></div>
    <ul id="publication-list">
        <?php    
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
			        
            /*
                Available Fields: 
                
                The field TYPE will be used for data-filtering. If it is not available then the item will be 
                marked as uncategorised.
                
                'note' 
                'abstract'
                'year'
                'group'
                'publisher'
                'location'
                'articleno'
                'numpages'
                'page-start'
                'page-end'
                'pages'
                'address'
                'url'
                'doi'
                'volume'
                'chapter'
                'journal'
                'author'
                'raw'
                'title'
                'booktitle'
                'folder'
                'type'
                'series'
                'linebegin'
                'lineend'
            
            */
            
            /* 
                Define the format that will be used for printing each bibtex item.
                If a you desire to print a string infront of a field please use the following format:
                
                article = array("title", "author", "string", "bibtex field");
                
                eg.
                
                article = array("title", "author", "Num. Of pages", "pages");
                
                Please modify the example below as desired  is presented bellow. 
            */
            
            $article = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $book = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $booklet = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $conference = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $inbook = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $incollection = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $inproceedings = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $manual = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $mastersthesis = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $misc = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $phdthesis = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $proceedings = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $techreport = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $unpublished = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            $other = array("title", "author", "year", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn");
            
            /* 
                Delimiter for Seperating each bibtex field
            */
            
            $delimiter = '.';
			
			$sortby = array('book', 'journal', 'conference', 'demo','technical', 'other');
			$sortbyTitle = array('Book Chapter', 'Journal', 'Conference and Workshop Proceedings', 'Demonstrations', 'Technical Reports', 'Other');
                            
            include './bibtex/BibTex.php';				
            
            $bibTexFile = './bibtex/demo.bib';
            
            $bibTex = new BibTeX_Parser();
            $bibTex->parser($file = $bibTexFile); 
        ?>
      <div class="clear"></div>
    </ul>
  </div>

</body>
</html>