<?php

/**
 * This is the categories-action, it will display the overview of faq categories
 *
 * @package		backend
 * @subpackage	faq
 *
 * @author 		Lester Lievens <lester@netlash.com>
 * @since		2.1
 */
class BackendFaqCategories extends BackendBaseActionIndex
{
	/**
	 * Execute the action
	 *
	 * @return	void
	 */
	public function execute()
	{
		// call parent, this will probably add some general CSS/JS or other required files
		parent::execute();

		// load datagrids
		$this->loadDataGrid();

		// parse page
		$this->parse();

		// display the page
		$this->display();
	}


	/**
	 * Loads the datagrid
	 *
	 * @return void
	 */
	private function loadDataGrid()
	{
		// create datagrid
		$this->datagrid = new BackendDataGridDB(BackendFaqModel::QRY_DATAGRID_BROWSE_CATEGORIES, BL::getWorkingLanguage());

		// disable paging
		$this->datagrid->setPaging(false);

		// enable drag and drop
		$this->datagrid->enableSequenceByDragAndDrop();

		// set column URLs
		$this->datagrid->setColumnURL('name', BackendModel::createURLForAction('edit_category') .'&amp;id=[id]');

		// add edit column
		$this->datagrid->addColumn('edit', null, BL::getLabel('Edit'), BackendModel::createURLForAction('edit_category') .'&amp;id=[id]', BL::getLabel('Edit'));
	}


	/**
	 * Parse & display the page
	 *
	 * @return	void
	 */
	private function parse()
	{
		$this->tpl->assign('datagrid', ($this->datagrid->getNumResults() != 0) ? $this->datagrid->getContent() : false);
	}
}

?>