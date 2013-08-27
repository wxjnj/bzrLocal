<?php
include dirname(__FILE__).'/../bootstrap/unit.php';

$content = <<<EEE
<P>KJKDSJFLKDSJFLKJFLK</P><p>jkl</p><p>pppooppppooooppppopp</p>
<p>斯蒂芬金当上了开发了肯定是就废了肯定是风了肯定是了肯定是流口水 </p>
<p>是的都是当上了金龙卡第三方</p>
<p>上当佛挡杀佛都是 </p>
<p>松是大幅度随碟附送</p>
EEE;
$ap = new ArticlePaging($content);

$t = new lime_test(4);
$t->diag('articlepaging()');
$t->isa_ok($ap->getPageCount(), 'integer',
		'getPageCount() returns a integer');
$t->is($ap->getPageCount(), 6,'getPageCount() return 6');
$t->isa_ok($ap->getContentByPage(2), 'string','getContentByPage(2) returns a string');
$t->is($ap->getContentByPage(2), '<p>jkl</p><p>pppooppppooooppppopp</p>','getContentByPage(2) return <p>jkl</p><p>pppooppppooooppppopp</p>');
