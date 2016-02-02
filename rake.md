---
layout: post
title: Rapid Automatic Keyword Extraction (RAKE)
---

# Keyword Extraction with RAKE
The RAKE implementation provides an unsupervised algorithm to extract keywords from documents.

###  Rake(TokensDocument $document, $nGramSize = NGramFactory::BIGRAM) 


```php

        $stopwords = array_map('trim', file(VENDOR_DIR.'yooper/stop-words/data/stop-words_english_1_en.txt'));
        // all punctuation must be moved 1 over. Fixes issues with sentences
        $testData = (new SpacePunctuationFilter())->transform($this->getTestData());
        //rake MUST be split on whitespace and new lines only
        $tokens = (new GeneralTokenizer(" \n\t\r"))->tokenize($testData);        
        $tokenDoc = new TokensDocument($tokens);
        $tokenDoc->applyTransformation(new LowerCaseFilter())
                ->applyTransformation(new StopWordsFilter($stopwords), false)
                ->applyTransformation(new PunctuationFilter(), false)
                ->applyTransformation(new CharFilter(), false);
                
        $rake = new Rake($tokenDoc, 3);
        $results = $rake->getKeywordScores();
        $this->assertArrayHasKey('minimal generating sets', $results);       
     
```   