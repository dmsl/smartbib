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
      <li><a href="#" data-filter=".book">Book Chapters</a></li>
      <li><a href="#" data-filter=".journal">Journal</a></li>
      <li><a href="#" data-filter=".conference">Conference and Workshop Proceedings</a></li>
      <li><a href="#" data-filter=".demo">Demonstrations</a></li>
      <li><a href="#" data-filter=".technical">Technical Reports</a></li>
      <li><a href="#" data-filter=".other">Other</a></li>
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
            
            $article = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $book = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $booklet = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $conference = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $inbook = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $incollection = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $inproceedings = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $manual = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $mastersthesis = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $misc = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $phdthesis = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $proceedings = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $techreport = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $unpublished = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            $other = array("title", "author", "year", "In ", "booktitle", "series", "pages" , "location", "publisher", "address","url");
            
            /* 
                Delimiter for Seperating each bibtex field
            */
            
            $delimiter = '.';
                            
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