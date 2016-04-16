<?php 
require_once('../vendor/autoload.php');


/**
 * Using PHP text analysis to generate a word cloud
 * @todo run php composer.phar require yooper/php-text-analysis
 * 
 */

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

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Word Cloud with PHP Text Analysis</title>
        <meta name="description" content="Word Cloud" />
        <meta name="keywords" content="word, cloud, PHP, text, analysis" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.16/d3.min.js"></script>
        <script src="/assets/js/d3.layout.cloud.js"></script>
    </head>
    <body>
        <h1>Unigram PHP Word Cloud Of Tom Sawyer </h1>
        
        <div id="wrapper">
            <div style="margin: 0 20px 0 20px;" id="php-word-cloud"></div>
        </div>

    <script>
        var words = <?php echo "$dataStr"; ?>;
        function drawWordCloud(rescale)
        {
            width = 1000;
            height = 1000;
            var fill = d3.scale.category20();
            d3.layout.cloud().size([width, height])
                .words(Object.keys(words).map(function(d)
                {
                    return {
                        text: d,
                        size: 25 + words[d] * rescale
                    };
                }))
                .padding(1)
                .rotate(function()
                {
                    return 0;
                })
                .font("Open Sans")
                .fontSize(function(d)
                {
                    return d.size;
                })
                .on("end", draw)
                .start();

            function draw(words)
            {
                d3.select("#php-word-cloud").append("svg")
                    .attr("width", width)
                    .attr("height", height)
                    .append("g")
                    .attr("transform", "translate(" + width / 2 + ", " + height / 2 + ")")
                    .selectAll("text")
                    .data(words)
                    .enter().append("text")
                    .style("font-size", function(d)
                    {
                        return d.size + "px";
                    })
                    .style("font-family", "Open Sans")
                    .style("fill", function(d, i)
                    {
                        return fill(i);
                    })
                    .attr("text-anchor", "middle")
                    .attr("transform", function(d)
                    {
                        return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                    })
                    .text(function(d)
                    {
                        return d.text;
                    });
            }
        }

        drawWordCloud(250);
    </script> 
    </body>
</html>