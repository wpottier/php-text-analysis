---
layout: post
title: Stanford NER Tagger (Named Entity Recognition)
---

# Named Entity Recognition with PHP Text Analysis
This feature enables Named Entity Recognition within the PHP text analysis library

###  StanfordNerTagger($jarPath, $classifierPath, $javaOptions = \['-mx700m'\], $separator = '/') 


```php

    // provide the directory where the stanford ner jar and classifier are located

    $document = new TokensDocument((new WhitespaceTokenizer())->tokenize($this->text));
        
    $jarPath = get_storage_path('ner').'stanford-ner.jar';
    $classiferPath = get_storage_path('ner'.DIRECTORY_SEPARATOR."classifiers")."english.all.3class.distsim.crf.ser.gz";
        
    $tagger = new StanfordNerTagger($jarPath, $classiferPath);
    $output = $tagger->tag($document->getDocumentData());     

    // $output[0] = [type, token]
     
```   
