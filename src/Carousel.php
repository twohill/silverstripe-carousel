<?php

namespace Twohill\Carousel\Extensions;

use Twohill\Carousel\Model\SlideImage;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\ORM\DataExtension;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class Carousel
 * @package Twohill\Carousel
 */
class Carousel extends DataExtension
{
    /**
     * @var array
     */
    private static $db = [];

    /**
     * @var array
     */
    private static $has_many = [
        'Slides' => SlideImage::class,
    ];
    
    private static $owns = [
        'Slides',
        ];


    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('Slides');

        // Slides
        if ($this->owner->ID) {
            $config = GridFieldConfig_RecordEditor::create();
            $config->addComponent(new GridFieldOrderableRows('SortOrder'));
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->removeComponentsByType('GridFieldDeleteAction');
            $config->addComponent(new GridFieldDeleteAction(false));
            $slideTitle = $this->owner->stat('slide_tab_title') ?: _t(__CLASS__ . '.SLIDES', 'Slides');

            $fields->addFieldToTab("Root.{$slideTitle}", GridField::create(
                'Slides',
                _t(__CLASS__ . '.SLIDES', 'Slides'),
                $this->owner->Slides()->sort('SortOrder'),
                $config
            ));


        }
    }

    /**
     * @return mixed
     */
    public function getSlideShow()
    {
        return $this->owner->Slides()->sort('SortOrder');
    }
}
