Publication-Parser-and-Beautifier
=================================

Parsing publications from a BibTex file and elegantly presenting those publications to the end user.

Demo
====

Visit: http://bibtex-parser.herokuapp.com/

Usage
=====

```php

<div class="publications"> 
    <h3 class="main-heading"><span>Publications</span></h3>
    <ul id="publication-filter">
      <li><a href="#" class="current" data-filter="*">All</a></li>
      <li><a href="#" data-filter=".journals">Journals</a></li>
      <li><a href="#" data-filter=".conferences">Conference and Workshop Proceedings</a></li>
      <li><a href="#" data-filter=".demos">Demonstrations</a></li>
      <li><a href="#" data-filter=".technical">Technical Reports</a></li>
    </ul>
    <div style="clear:both;"></div>
    <ul id="publication-list">
        <?php            
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
            
            $article = array();
            $book = array();
            $booklet = array();
            $conference = array();
            $inbook = array();
            $incollection = array();
            $inproceedings = array("title", "author", "year", "In", "booktitle", "(", "series", ") ", "location", "publisher", "address", "Article ", "articleno", "numpages"," pages. ", "DOI=", "doi", "url");
            $manual = array();
            $mastersthesis = array();
            $misc = array();
            $phdthesis = array();
            $proceedings = array();
            $techreport = array();
            $unpublished = array();
            $other = array();
            
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
```

Available BibTex Fields:
=======================

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
    
Beautification configuration:
======================

1. Define the format that will be used for printing each bibtex item.
   
   If a you desire to print a string infront of a field please use the following format:
                
     ```php
     article = array("title", "author", "string", "bibtex field");
     ```
  eg.

    ```php
    article = array("title", "author", "Num. Of pages", "pages");
    ```

  Full Example:
    
    ```php
    $inproceedings = array("title", "author", "year", "In", "booktitle", "(", "series", ") ", "location", "publisher", "address", "Article ", "articleno", "numpages"," pages. ", "DOI=", "doi", "url");
    ```

2. Please insert a `type` field for each item in your BibTex file.

3. Those types will be fildered according the following HTML code:

    ```html
    <ul id="publication-filter">
      <li><a href="#" class="current" data-filter="*">All</a></li>
      <li><a href="#" data-filter=".journals">Journals</a></li>
      <li><a href="#" data-filter=".conferences">Conference and Workshop Proceedings</a></li>
      <li><a href="#" data-filter=".demos">Demonstrations</a></li>
      <li><a href="#" data-filter=".technical">Technical Reports</a></li>
    </ul>
    ```
    
4. For example an item with `type = { journal }` in your BibTex will be filtered when Journals link is clicked.


Credits:
========

+ Data Management Systems Laboratory, University of Cyprus
+ Isotope jQuery (http://isotope.metafizzy.co/)
+ (Modified) BuddyPress BibTex Parser (https://github.com/scholarpress/buddypress-courseware/blob/master/bibliography/bibtex-parser.class.php)
+ Georgios Larkou (http://www.cs.ucy.ac.cy/~glarko01/)
