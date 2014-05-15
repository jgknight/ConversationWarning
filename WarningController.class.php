<?php
// Copyright 2014 Tristan van Bokkem

if (!defined("IN_ESOTALK")) exit;

class WarningController extends ETController {

	protected function model()
	{
		return ET::getInstance("warningModel");
	}

	protected function plugin()
	{
		return ET::$plugins["ConversationWarning"];
	}

	public function action_index($conversationId)
	{
		// Get the existing warning.
		$model = ET::getInstance("warningModel");
		$result = $model->getWarning($conversationId);
		$warning = $result->result();

		// Set up the form.
		$form = ETFactory::make("form");
		$form->addHidden("conversationId", $conversationId);
		$form->setValue("warning", $warning);
		$form->action = URL("warning");

		// Was the save button pressed?
		if ($form->validPostBack("warningSave")) {

			// Get the conversationId and warning values
			$conversationId = $form->getValue("conversationId");
			$warning = $form->getValue("warning");

			// Update the conversation warning column with the warning.
			$model = $this->model();
			$model->update($conversationId, $warning);

			// If there were errors, pass them on to the form.
			if ($model->errorCount()) $form->errors($model->errors());

			// Otherwise, redirect back to the conversation page.
			else $this->redirect(URL("conversation/".$conversationId));
		}

		$this->data("form", $form);
		$this->responseType = RESPONSE_TYPE_VIEW;
		$this->render($this->plugin()->view("add"));
	}

	public function action_remove($conversationId)
	{
		// We can't do this if we're not admin.
		if (!ET::$session->isAdmin() or !$this->validateToken()) return false;

		// Remove the warning.
		$model = ET::getInstance("warningModel");
		$result = $model->update($conversationId);
		$warning = $result->result();

		return $warning;
	}
}
