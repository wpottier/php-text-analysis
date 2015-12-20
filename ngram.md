---
layout: post
title: NGram Generator with PHP
---

# NGram Generator with PHP Text Analysis
The NGramGenerator produces a set of re-occurring tokens. By default, the **NGramFactory::create**
will generate bigrams from the provided set of tokens. 

### NGramFactory::create(array $tokens, int $nGramSize = self::BIGRAM, $separator = ' '

```php

$tokens = ["one","two","three"];
$expected = ["one two","two three"];
$bigrams = NGramFactory::create($tokens);
$this->assertEquals($expected, $bigrams);        


$tokens = ["one","two","three","four"];
$expected = ["one two three","two three four"];
$trigrams = NGramFactory::create($tokens, NGramFactory::TRIGRAM);
$this->assertEquals($expected, $trigrams);        
     
```   


