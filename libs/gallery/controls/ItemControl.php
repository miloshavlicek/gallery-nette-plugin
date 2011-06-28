<?php

/**
 * @author Martin Štekl <martin.stekl@gmail.com>
 * @since 2011-06-26
 */
class ItemControl extends AbstractGalleryControl {

	/**
	 * @var int
	 */
	protected $group_id;
	
	/**
	 * @param ComponentContainer $parent
	 * @param string $name
	 * @param GalleryEnvironment $environment
	 * @param int $group_id
	 */
	public function __construct(ComponentContainer $parent, $name, GalleryEnvironment $environment, $group_id) {
		parent::__construct($parent, $name, $environment);
		$this->group_id = $group_id;
	}
	
	/**
	 * Creates new instance of control.
	 * 
	 * @param ComponentContainer $parent
	 * @param string $name
	 * @param GalleryEnvironment $environment
	 * @param int $group_id
	 * @return ItemControl
	 */
	public static function create(ComponentContainer $parent, $name, GalleryEnvironment $environment, $group_id) {
		return new self($parent, $name, $environment, $group_id);
	}
	
	/**
	 * Renders item list.
	 */
	public function render() {
		$this->template->isAdmin = $this->isAdmin;
		$this->template->items = $this->environment->itemModel->getByGallery($this->group_id, $this->isAdmin);
		$this->template->setFile(dirname(__FILE__) . '/items.latte');
		$this->template->render();
	}
	
	/**
	 * Toggles activity/visibility of item.
	 * 
	 * @param int $id
	 */
	public function handleToggleActive($id) {
		$this->template->setFile(dirname(__FILE__) . '/items.latte');
		$this->environment->itemModel->toggleActive($id);
		$this->invalidateControl('item-table');
	}

	/**
	 * Deletes file.
	 * 
	 * @param int $id
	 */
	public function handleDelete($id) {
		$this->template->setFile(dirname(__FILE__) . '/items.latte');
		$this->environment->itemModel->delete($id);
		$this->invalidateControl('item-table');
	}
	
	/**
	 * Changes ordering of file to left.
	 * 
	 * @param int $id
	 */
	public function handleMoveLeft($id) {
		$this->template->setFile(dirname(__FILE__) . '/items.latte');
		$this->environment->itemModel->moveLeft($id);
		$this->invalidateControl('item-table');
	}

	/**
	 * Changes ordering of file to right.
	 * 
	 * @param int $id
	 */
	public function handleMoveRight($id) {
		$this->template->setFile(dirname(__FILE__) . '/items.latte');
		$this->environment->itemModel->moveRight($id);
		$this->invalidateControl('item-table');
	}
	
}
