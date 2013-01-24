#!/bin/bash
# 
# This file is part of Jbh_AjaxCart for Magento.
# 
# @license Lesser General Public License v3 (http://www.gnu.org/licenses/lgpl-3.0.txt)
# @author Jacques Bodin-Hullin <jacques@bodin-hullin.net>
# @category Jbh
# @package Jbh_AjaxCart
# @copyright Copyright (c) 2013 Jacques Bodin-Hullin (http://jacques.sh/)
# 

# Usage
function usage() {
    echo "Usage: ./install.sh [un]install [magento dir]"
    exit 1
}

# check argc
if [[ $# != 2 ]]; then
    usage
fi

# workspace
workspace=$2

# the module
pool=community
namespace=Jbh
namespaceLower=jbh
module=AjaxCart
moduleLower=ajaxcart

# case install or uninstall
case $1 in
    install)
        # force uninstall
        $0 uninstall $2 > /dev/null
        # create dir for the namespace
        mkdir $workspace/app/code/$pool/$namespace 2> /dev/null
        ln -s `pwd`/app/code/$pool/${namespace}/${module} $workspace/app/code/$pool/${namespace}/${module}
        ln -s `pwd`/app/etc/modules/${namespace}_${module}.xml $workspace/app/etc/modules/${namespace}_${module}.xml
        ln -s `pwd`/app/design/frontend/base/default/layout/${namespaceLower}_${moduleLower}.xml $workspace/app/design/frontend/base/default/layout/${namespaceLower}_${moduleLower}.xml
        ln -s `pwd`/app/design/frontend/base/default/template/${namespaceLower}_${moduleLower} $workspace/app/design/frontend/base/default/template/${namespaceLower}_${moduleLower}
        ln -s `pwd`/js/${namespaceLower}_${moduleLower} $workspace/js/${namespaceLower}_${moduleLower}
    ;;
    uninstall)
        rmdir $workspace/app/code/$pool/${namespace} 2> /dev/null
        rm $workspace/app/code/$pool/${namespace}/${module} 2> /dev/null
        rm $workspace/app/etc/modules/${namespace}_${module}.xml 2> /dev/null
        rm $workspace/app/design/frontend/base/default/layout/${namespaceLower}_${moduleLower}.xml 2> /dev/null
        rm $workspace/app/design/frontend/base/default/template/${namespaceLower}_${moduleLower} 2> /dev/null
        rm $workspace/js/${namespaceLower}_${moduleLower} 2> /dev/null
    ;;
    *)
        usage
    ;;
esac

echo "success"
exit 0
