--TEST--
PEAR_Registry->getChannels() (API v1.1)
--SKIPIF--
<?php
if (!getenv('PHP_PEAR_RUNTESTS')) {
    echo 'skip';
}
require_once 'PEAR/Registry.php';
$pv = phpversion() . '';
$av = $pv{0} == '4' ? 'apiversion' : 'apiVersion';
if (!in_array($av, get_class_methods('PEAR_Registry'))) {
    echo 'skip';
}
if (PEAR_Registry::apiVersion() != '1.1') {
    echo 'skip';
}
?>
--FILE--
<?php
error_reporting(E_ALL);
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'setup.php.inc';
$ch = new PEAR_ChannelFile;
$ch->setName('test.test.test');
$ch->setAlias('foo');
$ch->setSummary('blah');
$ch->setDefaultPEARProtocols();
$reg->addChannel($ch);
$phpunit->assertNoErrors('setup');

$ret = $reg->getChannels();
$phpunit->assertEquals(3, count($ret), 'count($ret)');
$phpunit->assertIsa('PEAR_ChannelFile', $ret[0], '$ret[0]');
$phpunit->assertIsa('PEAR_ChannelFile', $ret[1], '$ret[1]');
$phpunit->assertIsa('PEAR_ChannelFile', $ret[2], '$ret[2]');

$phpunit->assertEquals('pear.php.net', $ret[0]->getName(), '0 name');
$phpunit->assertEquals('test.test.test', $ret[1]->getName(), '1 name');
$phpunit->assertEquals('__uri', $ret[2]->getName(), '2 name');
echo 'tests done';
?>
--EXPECT--
tests done
