---
layout: post
title: Word Cloud with PHP Text Analysis
---

# Word Cloud with PHP Text Analysis
A word cloud is a collection of text that has each word sized based on its frequency
or significance.

The code can be found here

## A Simple Word Cloud with PHP

``` php
$content = file_get_contents('../vendor/yooper/php-text-analysis/tests/data/books/tom_sawyer.txt');

$tokens = (new \TextAnalysis\Tokenizers\WhitespaceTokenizer())->tokenize($content);

$doc = new \TextAnalysis\Documents\TokensDocument($tokens);
$doc->applyTransformation(new \TextAnalysis\Filters\StopWordsFilter(StopWordFactory::get('stop-words_english_1_en.txt')) )
    ->applyTransformation(new \TextAnalysis\Filters\PossessiveNounFilter())
    ->applyTransformation(new \TextAnalysis\Filters\LowerCaseFilter())
    ->applyTransformation(new \TextAnalysis\Filters\PunctuationFilter());

$freqDist = new \TextAnalysis\Analysis\FreqDist($doc->getDocumentData());

$totals = $freqDist->getKeyValuesByWeight();

// take the top 200 terms
$dataStr = json_encode(array_slice($totals,0, 200), JSON_NUMERIC_CHECK);

```

You will need to use the D3 library and the D3 cloud library.

![alt text](/images/examples/word_cloud.PNG "Word Cloud")
 



