<?php
/*
  $Id: rpc.php v1.0 2013-01-01 datazen $

  LoadedCommerce, Innovative eCommerce Solutions
  http://www.loadedcommerce.com

  Copyright (c) 2013 Loaded Commerce, LLC

  @author     LoadedCommerce Team
  @copyright  (c) 2013 LoadedCommerce Team
  @license    http://loadedcommerce.com/license.html

  @function The lC_Updater_Admin_rpc class is for AJAX remote program control
*/
require_once('includes/applications/updates/classes/updates.php');    
require_once('includes/applications/backup/classes/backup.php');    

class lC_Updates_Admin_rpc {
 /*
  * Returns the modules datatable data for listings
  *
  * @access public
  * @return json
  */
  public static function hasUpdates() {
    $result = lC_Updates_Admin::hasUpdatesAvailable();

    echo json_encode($result);
  }
 /*
  * Download the update package
  *
  * @access public
  * @return json
  */
  public static function getUpdatePackage() {
    $result = array();
    if (lC_Updates_Admin::downloadPackage($_GET['version'])) {
      $result['rpcStatus'] = RPC_STATUS_SUCCESS;
    }

    echo json_encode($result);
  }  
 /*
  * Get the update package contents
  *
  * @access public
  * @return json
  */
  public static function getContents() {
    $result = lC_Updates_Admin::getPackageContents();
    if (isset($result['total'])) $result['rpcStatus'] = RPC_STATUS_SUCCESS;
    
    echo json_encode($result);
  } 
 /*
  * Perform a database backup
  *
  * @param boolean $_GET['compression'] True = create backup using compression
  * @param boolean false Turn off local only backup
  * @access public
  * @return json
  */
  public static function doDBBackup() {
    if ( lC_Backup_Admin::backup($_GET['compression'], false)) {
      $result['rpcStatus'] = RPC_STATUS_SUCCESS;
    }

    echo json_encode($result);
  }  
 /*
  * Perform a full file backup
  *
  * @access public
  * @return json
  */
  public static function doFullFileBackup() {
    if ( lC_Updates_Admin::fullBackup()) {
      $result['rpcStatus'] = RPC_STATUS_SUCCESS;
    }

    echo json_encode($result);
  }
 /*
  * Perform a full file restore
  *
  * @access public
  * @return json
  */
  public static function doFullFileRestore() {
    if ( lC_Updates_Admin::fullFileRestore()) {
      $result['rpcStatus'] = RPC_STATUS_SUCCESS;
    }

    echo json_encode($result);
  }  
 /*
  * Deploy the update package
  *
  * @access public
  * @return json
  */
  public static function installUpdate() {
    if ( lC_Updates_Admin::applyPackage()) {
      $result['rpcStatus'] = RPC_STATUS_SUCCESS;
    }

    echo json_encode($result);
  }      
  
}
?>