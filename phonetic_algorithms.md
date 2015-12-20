---
layout: post
title: Phonetic Algorithms
---


# Phonetic Algorithms and PHP Text Analysis

There are couple phonetic algorithms available within PHP Text Analysis. Phonetic algorithms are 
commonly used to match data based on the pronunciation. Each phonetic algorithm implements the 
**ITokenTransformation** interface. Create an instance of the class then call **transform** on the
token. 

### MetaphonePhonetic()
Native wrapper for PHP's metaphone function

```php
$metaphone = new MetaphonePhonetic();
$token = $metaphone->transform("Johnny");
```

### SoundexPhonetic()
Wrapper for PHP's native soundex 

```php
$soundex = new SoundexPhonetic();
$token = $soundex->transform("Johnny");
```
