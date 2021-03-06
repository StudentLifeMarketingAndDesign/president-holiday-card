<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);
    /**
     * Return a list of all the pages to cache
     *
     * @return array
     */
    public function allPagesToCache() {
        // Get each page type to define its sub-urls
        $urls = array();

        // memory intensive depending on number of pages
        $pages = Page::get();

        foreach($pages as $page) {
            $urls = array_merge($urls, (array)$page->subPagesToCache());
        }

        // add any custom URLs which are not SiteTree instances
        $urls[] = "sitemap.xml";

        return $urls;
    }

    /**
     * Get a list of URLs to cache related to this page.
     *
     * @return array
     */
    public function subPagesToCache() {
        $urls = array();

        // add current page
        $urls[] = $this->Link();

        // cache the RSS feed if comments are enabled
        if ($this->ProvideComments) {
            $urls[] = Director::absoluteBaseURL() . "CommentingController/rss/SiteTree/" . $this->ID;
        }

        return $urls;
    }

    /**
     * Get a list of URL's to publish when this page changes
     */
    public function pagesAffectedByChanges() {
        $urls = $this->subPagesToCache();
        if($p = $this->Parent) $urls = array_merge((array)$urls, (array)$p->subPagesToCache());
        return $urls;
    }

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
	);

	public function BuildingPages(){
		return BuildingPage::get();
	}

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

}
