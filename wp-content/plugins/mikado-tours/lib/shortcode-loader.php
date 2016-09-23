<?php
namespace MikadofTours\Lib;

use MikadofTours\CPT\Destination\Shortcodes\DestinationGrid;
use MikadofTours\CPT\Tours;
use MikadofTours\CPT\Tours\Shortcodes\SliderWithFilter;
use MikadofTours\CPT\Tours\Shortcodes\TopReviewsCarousel;
use MikadofTours\CPT\Tours\Shortcodes\ToursCarousel;
use MikadofTours\CPT\Tours\Shortcodes\ToursFilter;
use MikadofTours\CPT\Tours\Shortcodes\ToursList;
use MikadofTours\CPT\Tours\Shortcodes\TourCoverBoxes;
use MikadofTours\CPT\Tours\Shortcodes\TourTypeList;

/**
 * Class ShortcodeLoader
 * @package MikadofTours\Lib
 */
class ShortcodeLoader {
    /**
     * @var private instance of current class
     */
    private static $instance;
    /**
     * @var array
     */
    private $loadedShortcodes = array();

    /**
     * Private constuct because of Singletone
     */
    private function __construct() {
    }

    /**
     * Private sleep because of Singletone
     */
    private function __wakeup() {
    }

    /**
     * Private clone because of Singletone
     */
    private function __clone() {
    }

    /**
     * Returns current instance of class
     * @return ShortcodeLoader
     */
    public static function getInstance() {
        if(self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    /**
     * Adds new shortcode. Object that it takes must implement ShortcodeInterface
     *
     * @param ShortcodeInterface $shortcode
     */
    private function addShortcode(ShortcodeInterface $shortcode) {
        if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
            $this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
        }
    }

    /**
     * Adds all shortcodes.
     *
     * @see ShortcodeLoader::addShortcode()
     */
    private function addShortcodes() {
        $this->addShortcode(new ToursCarousel());
        $this->addShortcode(new ToursList());
        $this->addShortcode(new TourCoverBoxes());
        $this->addShortcode(new DestinationGrid());
        $this->addShortcode(new ToursFilter());
        $this->addShortcode(new SliderWithFilter());
        $this->addShortcode(new TourTypeList());
        $this->addShortcode(new TopReviewsCarousel());
    }

    /**
     * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
     * of each shortcode object
     */
    public function load() {
        $this->addShortcodes();

        foreach($this->loadedShortcodes as $shortcode) {
            add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
        }

    }
}