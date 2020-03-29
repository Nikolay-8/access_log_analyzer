<?php
namespace Counter\Element;
use Interfaces\CounterElementrInterface;

class CrawlersCounter implements CounterElementrInterface {
    const CRAWLER_GOOGLE = 'Google';
    const CRAWLER_BING = 'Bing';
    const CRAWLER_BAIDU = 'Baidu';
    const CRAWLER_YANDEX = 'Yandex';

    /**
     * @var array
     */
    private $crawlerToRegularExpression = array(
        self::CRAWLER_GOOGLE => '(Googlebot)',
        self::CRAWLER_BING => '(Bingbot)',
        self::CRAWLER_BAIDU => '(Baidubot)',
        self::CRAWLER_YANDEX => '(Yandexbot)'
    );

    /**
     * @var array
     */
    private $crawlers = array(
        self::CRAWLER_GOOGLE => 0,
        self::CRAWLER_BING => 0,
        self::CRAWLER_BAIDU => 0,
        self::CRAWLER_YANDEX => 0
    );

    /**
     * @param $clientData
     */
    public function addValue($clientData) {
        foreach ($this->crawlerToRegularExpression as $crawler => $regExp) {
            if (preg_match ($regExp, $clientData, $matches)) {
                ++ $this->crawlers[$crawler];
                break;
            }
        }
    }

    /**
     * @return array
     */
    public function getResult() : array {
        return array('crawlers' => $this->crawlers);
    }
}