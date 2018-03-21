<?php

namespace Twohill\Carousel\Model;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;
use Sheadawson\Linkable\Models\Link;

/**
 * Class SlideImage
 * @package Twohill\Carousel\Model
 * @property string $Title
 * @property string $Text
 * @property int $SortOrder
 * @property int $ImageID
 * @property int $PageID
 * @property int $LinkID
 */
class SlideImage extends DataObject implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = 'Slide';

    /**
     * @var string
     */
    private static $plural_name = 'Slides';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Text' => 'HTMLText',
        'SortOrder' => 'Int',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Image' => Image::class,
        'Page' => \Page::class,
        'Link' => Link::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image'
    ];

    /**
     * @var string
     */
    private static $table_name = 'SlideImage';

    /**
     * @var string
     */
    private static $default_sort = 'SortOrder';

    /**
     * Adds Publish button to SlideImage record
    *
    * @var bool
    */
    private static $versioned_gridfield_extensions = true;

    /**
     * @var array
     */
    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Text' => 'Text',
    ];

    /**
     * @var array
     */
    private static $searchable_fields = [
        'Title',
        'Text',
    ];

    /**
     * @var int
     */
    private static $image_size_limit = 512000;

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'ShowSlide',
            'SortOrder',
            'PageID',
            'Image',
        ]);

        // Title
        $fields->dataFieldByName('Title')
            ->setTitle(
                _t(__CLASS__ . '.TITLE', 'Title')
            )
            ->setDescription(
                _t(__CLASS__ . '.USED_IN_TEMPLATE', 'optional, used in template')
            );

        // Text
        $fields->dataFieldByName('Text')
            ->setTitle(
                _t(__CLASS__ . '.TEXT', 'Text')
            )
            ->setDescription(
                _t(__CLASS__ . '.USED_IN_TEMPLATE', 'optional, used in template')
            );

        // Page link
        $fields->dataFieldByName('LinkID')
            ->setTitle(
                _t(__CLASS__ . '.PAGE_LINK', "Optional link")
            );

        // Image
        $image = UploadField::create(
            'Image',
            _t(__CLASS__ . '.IMAGE', 'Image')
        )->setFolderName('Uploads/Carousel');

        $image->getValidator()->setAllowedExtensions(['jpg', 'jpeg', 'png', 'gif']);

        $fields->insertAfter($image, 'Text');

        $this->extend('updateSlideImageFields', $fields);

        return $fields;
    }

    /**
     * @return \SilverStripe\ORM\ValidationResult
     */
    public function validate()
    {
        $result = parent::validate();


        if (!$this->ImageID) {
            $result->addError(
                _t(__CLASS__ . '.IMAGE_REQUIRED', 'An Image is required before you can save')
            );
        }

        return $result;
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'Slide_EDIT' => 'Slide Edit',
            'Slide_DELETE' => 'Slide Delete',
            'Slide_CREATE' => 'Slide Create',
        );
    }

    /**
     * @param null $member
     * @param array $context
     *
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('Slide_CREATE', 'any', $member);
    }

    /**
     * @param null $member
     * @param array $context
     *
     * @return bool|int
     */
    public function canEdit($member = null, $context = [])
    {
        return Permission::check('Slide_EDIT', 'any', $member);
    }

    /**
     * @param null $member
     * @param array $context
     *
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('Slide_DELETE', 'any', $member);
    }

    /**
     * @param null $member
     * @param array $context
     *
     * @return bool
     */
    public function canView($member = null, $context = [])
    {
        return true;
    }
}
