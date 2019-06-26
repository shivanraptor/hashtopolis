<?php

class PreprocessorHandler implements Handler {
  public function __construct($hashcatId = null) {
    //nothing
  }
  
  public function handle($action) {
    try {
      switch ($action) {
        case DPreprocessorAction::ADD_PREPROCESSOR:
          AccessControl::getInstance()->checkPermission(DPreprocessorAction::ADD_PREPROCESSOR_PERM);
          PreprocessorUtils::addPreprocessor($_POST['name'], $_POST['binaryName'], $_POST['url'], $_POST['keyspaceCommand'], $_POST['skipCommand'], $_POST['limitCommand']);
          break;
        case DPreprocessorAction::DELETE_PREPROCESSOR:
          AccessControl::getInstance()->checkPermission(DPreprocessorAction::DELETE_PREPROCESSOR_PERM);
          PreprocessorUtils::delete($_POST['preprocessorId']);
          break;
        default:
          UI::addMessage(UI::ERROR, "Invalid action!");
          break;
      }
    }
    catch (HTException $e) {
      UI::addMessage(UI::ERROR, $e->getMessage());
    }
  }
}