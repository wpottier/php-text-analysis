---
layout: post
title: Text Console
---

# textconsole 

Is a command line program for performing some basic tasks. You can see the available
commands that textconsole has to offer by typing the following in the CLI. 

```bash
php textconsole
```

There are two commands available:
```bash
php textconsole nltk:list
``` 

This lists out the available corpora offered by the nltk project. To download and install
a corpus package, use the following command

```bash
php textconsole nltk:install-package package-name
```

This will install the corpus into the into the storage/corpora directory. To load
and manipulate the corpus, you can use the (ImportCorpus)[import_corpus] class.