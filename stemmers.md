---
layout: post
title: Stemmer Algorithms
---


# Stemmer Algorithms and PHP Text Analysis

There are several stemmer algorithms available within PHP Text Analysis. Stemmer algorithms implement the 
IStemmer inferface which has a single method **stemmer** that accepts a token and returns a token. 

### DictionaryStemmer(ISpelling $spell, IStemmer $stemmer, $whiteList = [])
The **DictionaryStemmer** allows the developer to provide:
 * a dictionary 
 * a stemmer 
 * white list of words that can be excluded from stemming

The **ISpell interface** currently to 2 classes that are concrete implementations. The *EnchantAdapter* 
and the *PspellAdapter*. The dictionary adapter classes return an array of suggestions for the word. The
dictionary lookup is performed after the stemmer has been applied to the token. 

The **IStemmer $stemmer** param lets you select the type of stemmer you would like to use. 
This requires several packages to be installed through **yum** or **apt-get**

```
$stemmer = new DictionaryStemmer(new PspellAdapter(), new SnowballStemmer());           
$this->assertEquals("judge", $stemmer->stem("judges"));
// some times approach does not work, and it is recommended to leverage the whiteList to exclude
// some tokens from being stemmed
$this->assertNotEquals('university', $stemmer->stem("university")); 
$this->assertEquals('hammock', $stemmer->stem("hammok")); 
```

### LambdaStemmer()

This stemmer allows the developer to quickly create a stemmer without requiring any
additional classes. 

```
$lambdaFunc = function($word) {
    return preg_filter("/my/i", "", $word);
};
        
$stemmer = new LambdaStemmer($lambdaFunc);
$this->assertEquals("tom", $stemmer->stem("tommy"));
```

### LancasterStemmer()

This stemmer implements the Lancaster stemmer, see
Paice, Chris D. "Another Stemmer." ACM SIGIR Forum 24.3 (1990): 56-61.

```
$stemmer = new LancasterStemmer();
$this->assertEquals('maxim', $stemmer->stem('maximum'));
$this->assertEquals('presum', $stemmer->stem('presumably'));       
$this->assertEquals('multiply', $stemmer->stem('multiply'));     
$this->assertEquals('provid', $stemmer->stem('provision'));  
$this->assertEquals('ow', $stemmer->stem('owed'));            
$this->assertEquals('ear', $stemmer->stem('ear'));           
$this->assertEquals('say', $stemmer->stem('saying'));      
$this->assertEquals('cry', $stemmer->stem('crying'));
$this->assertEquals('string', $stemmer->stem('string'));
$this->assertEquals('meant', $stemmer->stem('meant')); 
$this->assertEquals('cem', $stemmer->stem('cement')); 
$this->assertEquals( null, $stemmer->stem(' ')); 
```

### LookupStemmer(IDataReader $reader)
The data reader returns an associative array where the key is the lookup and the
value replaces the token

```
$jsonStr = '{ "ended":"end", "ending": "end"}';
$jsonReader = new JsonDataAdapter($jsonStr);        
$stemmer = new LookupStemmer($jsonReader);
$this->assertEquals("end", $stemmer->stem("ending"));
$this->assertEquals("end", $stemmer->stem("ended"));
// array data reader example
$stemmer = new LookupStemmer(new ArrayDataAdapter(['ended'=>'end','ending'=>'end]));
$this->assertEquals("end", $stemmer->stem("ending"));
$this->assertEquals("end", $stemmer->stem("ended"));
```



### PorterStemmer()
**Todo, Not Implemented**

### RegexStemmer($regexExpression, $minimumTokenLength = 4)
Uses a preg_replace to substitute in changes based on the passed in regular expression

```
$stemmer = new RegexStemmer('ing$|s$|e$', 4);
$this->assertEquals("car", $stemmer->stem("car"));
$this->assertEquals("mas", $stemmer->stem("mass"));
$this->assertEquals("was", $stemmer->stem("was"));
$this->assertEquals("bee", $stemmer->stem("bee"));
$this->assertEquals("comput", $stemmer->stem("compute"));
```

### SnowballStemmer()
This stemmer just wraps the Pecl extension, https://pecl.php.net/package/stem/


```
$stemmer = new SnowballStemmer();
$this->assertEquals("judg", $stemmer->stem("judges"));

$stemmer = new SnowballStemmer('swedish');
$this->assertEquals("affärschef", $stemmer->stem("affärscheferna"));
```




