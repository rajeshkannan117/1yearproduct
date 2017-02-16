<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
               /* $class = $this->router->fetch_class();
                $method = $this->router->fetch_method();
                switch($class){
                    case 'country':
                        switch($method){
                            case 'add':
                                if(!in_array('create',$this->roles['country'])){
                                 die('unauthorised access');   
                                }
                                break;
                            case 'edit':
                                if((!in_array('update',$this->roles['country'])) && (!in_array('create',$this->roles['country']))){
                                    die('unauthorised accesss');
                                }
                                break;
                            case 'delete':
                                if(!in_array('delete',$this->roles['country'])){
                                    die('unauthorised access');
                                }
                                break;
                            case 'index':
                                if(!in_array('read',$this->roles['country'])){
                                    die('unauthorised access');
                                }
                            default:
                                break;
                        }
                        break;
                    case 'domain':
                         switch($method){
                            case 'add':
                                if(!in_array('create',$this->roles['domain'])){
                                 die('unauthorised access');   
                                }
                                break;
                            case 'edit':
                                if((!in_array('update',$this->roles['domain'])) && (!in_array('create',$this->roles['domain']))){
                                    die('unauthorised accesss');
                                }
                                break;
                            case 'delete':
                                if(!in_array('delete',$this->roles['domain'])){
                                    die('unauthorised access');
                                }
                                break;
                            case 'index':
                                if(!in_array('read',$this->roles['domain'])){
                                    die('unauthorised access');
                                }
                            default:
                                break;
                        }
                        break;
                    case 'department':
                         switch($method){
                            case 'add':
                                if(!in_array('create',$this->roles['department'])){
                                 die('unauthorised access');   
                                }
                                break;
                            case 'edit':
                                if((!in_array('update',$this->roles['department'])) && (!in_array('create',$this->roles['department']))){
                                    die('unauthorised accesss');
                                }
                                break;
                            case 'delete':
                                if(!in_array('delete',$this->roles['department'])){
                                    die('unauthorised access');
                                }
                                break;
                            case 'index':
                                if(!in_array('read',$this->roles['department'])){
                                    die('unauthorised access');
                                }
                            default:
                                break;
                        }
                        break;
                    case 'category':
                         switch($method){
                            case 'add':
                                if(!in_array('create',$this->roles['category'])){
                                 die('unauthorised access');   
                                }
                                break;
                            case 'edit':
                                if((!in_array('update',$this->roles['category'])) && (!in_array('create',$this->roles['category']))){
                                    die('unauthorised accesss');
                                }
                                break;
                            case 'delete':
                                if(!in_array('delete',$this->roles['category'])){
                                    die('unauthorised access');
                                }
                                break;
                            case 'index':
                                if(!in_array('read',$this->roles['category'])){
                                    die('unauthorised access');
                                }
                            default:
                                break;
                        }
                        break;
                    case 'organization':
                        switch($method){
                            case 'add':
                                if(!in_array('create',$this->roles['organization'])){
                                 die('unauthorised access');   
                                }
                                break;
                            case 'edit':
                                if((!in_array('update',$this->roles['organization'])) && (!in_array('create',$this->roles['organization']))){
                                    die('unauthorised accesss');
                                }
                                break;
                            case 'delete':
                                if(!in_array('delete',$this->roles['organization'])){
                                    die('unauthorised access');
                                }
                                break;
                            case 'index':
                                if(!in_array('read',$this->roles['organization'])){
                                    die('unauthorised access');
                                }
                            default:
                                break;
                        }
                        break;
                    case 'form':
                        switch($method){
                            case 'add':
                                if(!in_array('create',$this->roles['forms'])){
                                 die('unauthorised access');   
                                }
                                break;
                            case 'edit':
                                if((!in_array('update',$this->roles['users'])) && (!in_array('create',$this->roles['forms']))){
                                    die('unauthorised accesss');
                                }
                                break;
                            case 'delete':
                                if(!in_array('delete',$this->roles['forms'])){
                                    die('unauthorised access');
                                }
                                break;
                            case 'index':
                                if(!in_array('read',$this->roles['forms'])){
                                    die('unauthorised access');
                                }
                            default:
                                break;
                        }
                        break;
                    case 'users':
                        switch($method){
                            case 'add':
                                if(!in_array('create',$this->roles['users'])){
                                 die('unauthorised access');   
                                }
                                break;
                            case 'edit':
                                if((!in_array('update',$this->roles['users'])) && (!in_array('create',$this->roles['users']))){
                                    die('unauthorised accesss');
                                }
                                break;
                            case 'delete':
                                if(!in_array('delete',$this->roles['users'])){
                                    die('unauthorised access');
                                }
                                break;
                            case 'index':
                                if(!in_array('read',$this->roles['users'])){
                                    die('unauthorised access');
                                }
                            default:
                                break;
                        }
                        break;
                    case 'roles':
                        switch($method){
                            case 'add':
                                if(!in_array('create',$this->roles['roles'])){
                                 die('unauthorised access');   
                                }
                                break;
                            case 'edit':
                                if((!in_array('update',$this->roles['roles'])) && (!in_array('create',$this->roles['roles']))){
                                    die('unauthorised accesss');
                                }
                                break;
                            case 'delete':
                                if(!in_array('delete',$this->roles['roles'])){
                                    die('unauthorised access');
                                }
                                break;
                            case 'index':
                                if(!in_array('read',$this->roles['roles'])){
                                    die('unauthorised access');
                                }
                            default:
                                break;
                        }
                        break;
                        
                    default :
                        break;
                }*/
                
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}
