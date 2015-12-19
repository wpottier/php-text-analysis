# Tokenizers and PHP Text Analysis

There are several tokenizers available within PHP Text Analysis. Tokenizers parse 
free text into an array of tokens. There are several tokenizers available. All
tokenizers implement a **tokenize** method. The **tokenize** method will return an Array
of tokens. 

### FixedLengthTokenizer(int $startPostion, int $length = null)

Allows you to specify a string start position and length of string per line that should be tokenized. Useful when
you only want to grab the a fixed string per line.


```
$tokenizer = new FixedLengthTokenizer(2,4);
$tokens = $tokenizer->tokenize("Gabby Abby");
$this->assertCount(1, $tokens);
$this->assertEquals("bby ", end($tokens));  

$tokenizer = new FixedLengthTokenizer(0);
$tokens = $tokenizer->tokenize("Gabby Abby");
$this->assertCount(1, $tokens);
$this->assertEquals("Gabby Abby", end($tokens));
```

### GeneralTokenizer($tokenExpression = " \n\t\r,-!?"))
Wraps PHP's native function **strtok** to provide a general purpose tokenizer that works
well in most situations. The tokens are split using delimiters passed in via the constructor. 
The default set works well. 

```
$tokenizer = new GeneralTokenizer();
$tokens = $tokenizer->tokenize("This has some words");
```

### PennTreeBankTokenizer()
This tokenizer implements the PennTreeBank algorithm using PHP. The implementation is based
off of (http://www.cis.upenn.edu/~treebank/tokenizer.sed) Inside the constructor the rules
are initialized

```
$tokenizer = new PennTreeBankTokenizer();
$tokens = $tokenizer->tokenize("Good muffins cost $3.88\nin New York.  Please buy me\ntwo of them.\nThanks.");
$this->assertCount(16, $tokens);
```

### RegexTokenizer($pattern = self::DEFAULT_REGEX, $flags = 0, $offset = 0)
Wraps PHP's *preg_match_all* function. Uses a default regex of **/\w+|\$[\d\.]+|\S+/**.


```
//uses default regex
$tokenizer = new RegexTokenizer();
$tokens = $tokenizer->tokenize("Good muffins cost $3.88\nin New York.  Please buy me\ntwo of them.\nThanks.");
$this->assertCount(17, $tokens);

// only captures words
$tokenizer = new RegexTokenizer("/[A-Za-z]+/");
$tokens = $tokenizer->tokenize("Good muffins cost $3.88\nin New York.  Please buy me\ntwo of them.\nThanks.");
$this->assertCount(13, $tokens);
```

### SentenceTokenizer($tokenExpression = " \n\t\r,-!?"))
Extends the GeneralTokenizer. A token is the whole sentence. 

```
$tokenizer = new SentenceTokenizer();
$this->assertCount(2, $tokenizer->tokenize("This has some words. Why only 4 words?"));
$this->assertCount(2, $tokenizer->tokenize("My name is Yooper. I like programming!"));        
$this->assertCount(2, $tokenizer->tokenize("My name is Yooper!? I like programming!! !!"));   
```

### WhitespaceTokenizer()
Splits on whitespace and the subject strings are treated as UTF-8.

**TEST CASE NEEDED**


