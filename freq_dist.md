---
---


# Keyword Frequency Distribution Analysis using PHP Text Analysis

### FreqDist(array $tokens)

Extracts the frequency distribution of keywords from the set of provided tokens. The **FreqDist** 
provides several methods for obtaining information about the supplied tokens. 
The full API is available here (https://github.com/yooper/php-text-analysis/blob/master/src/Analysis/FreqDist.php)

```
$freqDist = new FreqDist(array("time", "flies", "like", "an", "arrow", "time", "flies", "like", "what"));
$this->assertTrue(count($freqDist->getHapaxes()) === 3);        
$this->assertEquals(9, $freqDist->getTotalTokens());
$this->assertEquals(6, $freqDist->getTotalUniqueTokens());

$freqDist = new FreqDist(array("time", "time", "what", "what"));
$this->assertTrue(count($freqDist->getHapaxes()) === 0);        
$this->assertEquals(4, $freqDist->getTotalTokens());
$this->assertEquals(2, $freqDist->getTotalUniqueTokens());

freqDist = new FreqDist(array("time"));
$this->assertTrue(count($freqDist->getHapaxes()) === 1);        
$this->assertEquals(1, $freqDist->getTotalTokens());
$this->assertEquals(1, $freqDist->getTotalUniqueTokens());  

```


