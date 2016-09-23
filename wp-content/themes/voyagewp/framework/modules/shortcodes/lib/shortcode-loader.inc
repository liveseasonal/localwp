<?php

namespace Voyage\Modules\Shortcodes\Lib;

use Voyage\Modules\CallToAction\CallToAction;
use Voyage\Modules\Counter\Countdown;
use Voyage\Modules\Counter\Counter;
use Voyage\Modules\ElementsHolder\ElementsHolder;
use Voyage\Modules\ElementsHolderItem\ElementsHolderItem;
use Voyage\Modules\GoogleMap\GoogleMap;
use Voyage\Modules\Separator\Separator;
use Voyage\Modules\PieCharts\PieChartBasic\PieChartBasic;
use Voyage\Modules\PieCharts\PieChartDoughnut\PieChartDoughnut;
use Voyage\Modules\PieCharts\PieChartDoughnut\PieChartPie;
use Voyage\Modules\PieCharts\PieChartWithIcon\PieChartWithIcon;
use Voyage\Modules\Shortcodes\AnimationsHolder\AnimationsHolder;
use Voyage\Modules\Shortcodes\BlogCarousel\BlogCarousel;
use Voyage\Modules\Shortcodes\BlogSlider\BlogSlider;
use Voyage\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTable;
use Voyage\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTablesHolder;
use Voyage\Modules\Shortcodes\Icon\Icon;
use Voyage\Modules\Shortcodes\IconProgressBar;
use Voyage\Modules\Shortcodes\ImageGallery\ImageGallery;
use Voyage\Modules\Shortcodes\InfoBox\InfoBox;
use Voyage\Modules\Shortcodes\Process\ProcessHolder;
use Voyage\Modules\Shortcodes\Process\ProcessItem;
use Voyage\Modules\Shortcodes\SectionSubtitle\SectionSubtitle;
use Voyage\Modules\Shortcodes\SectionTitle\SectionTitle;
use Voyage\Modules\Shortcodes\VerticalProgressBar\VerticalProgressBar;
use Voyage\Modules\Shortcodes\VideoBanner\VideoBanner;
use Voyage\Modules\Shortcodes\WorkingHours\WorkingHours;
use Voyage\Modules\SocialShare\SocialShare;
use Voyage\Modules\Team\Team;
use Voyage\Modules\OrderedList\OrderedList;
use Voyage\Modules\UnorderedList\UnorderedList;
use Voyage\Modules\Message\Message;
use Voyage\Modules\ProgressBar\ProgressBar;
use Voyage\Modules\IconListItem\IconListItem;
use Voyage\Modules\Tabs\Tabs;
use Voyage\Modules\Tab\Tab;
use Voyage\Modules\PricingTables\PricingTables;
use Voyage\Modules\PricingTable\PricingTable;
use Voyage\Modules\Accordion\Accordion;
use Voyage\Modules\AccordionTab\AccordionTab;
use Voyage\Modules\BlogList\BlogList;
use Voyage\Modules\Shortcodes\Button\Button;
use Voyage\Modules\Blockquote\Blockquote;
use Voyage\Modules\CustomFont\CustomFont;
use Voyage\Modules\Highlight\Highlight;
use Voyage\Modules\VideoButton\VideoButton;
use Voyage\Modules\Dropcaps\Dropcaps;
use Voyage\Modules\Shortcodes\IconWithText\IconWithText;
use Voyage\Modules\InfoItem\InfoItem;
use Voyage\Modules\InfoItems\InfoItems;

/**
 * Class ShortcodeLoader
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
        $this->addShortcode(new ElementsHolder());
        $this->addShortcode(new ElementsHolderItem());
        $this->addShortcode(new Team());
        $this->addShortcode(new Icon());
        $this->addShortcode(new CallToAction());
        $this->addShortcode(new OrderedList());
        $this->addShortcode(new UnorderedList());
        $this->addShortcode(new Message());
        $this->addShortcode(new Counter());
        $this->addShortcode(new Countdown());
        $this->addShortcode(new ProgressBar());
        $this->addShortcode(new IconListItem());
        $this->addShortcode(new Tabs());
        $this->addShortcode(new Tab());
        $this->addShortcode(new InfoItem());
        $this->addShortcode(new InfoItems());
        $this->addShortcode(new PricingTables());
        $this->addShortcode(new PricingTable());
        $this->addShortcode(new PieChartBasic());
        $this->addShortcode(new PieChartPie());
        $this->addShortcode(new PieChartDoughnut());
        $this->addShortcode(new PieChartWithIcon());
        $this->addShortcode(new Accordion());
        $this->addShortcode(new AccordionTab());
        $this->addShortcode(new BlogList());
        $this->addShortcode(new Button());
        $this->addShortcode(new Blockquote());
        $this->addShortcode(new CustomFont());
        $this->addShortcode(new Highlight());
        $this->addShortcode(new ImageGallery());
        $this->addShortcode(new GoogleMap());
        $this->addShortcode(new Separator());
        $this->addShortcode(new VideoButton());
        $this->addShortcode(new Dropcaps());
        $this->addShortcode(new IconWithText());
        $this->addShortcode(new SocialShare());
        $this->addShortcode(new VideoBanner());
        $this->addShortcode(new AnimationsHolder());
        $this->addShortcode(new SectionTitle());
        $this->addShortcode(new SectionSubtitle());
        $this->addShortcode(new BlogCarousel());
        $this->addShortcode(new InfoBox());
        $this->addShortcode(new ProcessHolder());
        $this->addShortcode(new ProcessItem());
        $this->addShortcode(new ComparisonPricingTablesHolder());
        $this->addShortcode(new ComparisonPricingTable());
        $this->addShortcode(new VerticalProgressBar());
        $this->addShortcode(new IconProgressBar());
        $this->addShortcode(new WorkingHours());
        $this->addShortcode(new BlogSlider());
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

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();