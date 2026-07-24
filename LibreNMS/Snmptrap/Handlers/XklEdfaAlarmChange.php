<?php
/**
 * XklEdfaAlarmChange.php
 *
 * -Description-
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link       http://librenms.org
 * @copyright  2026 <your name>
 * @author     <your name> <your email>
 */

namespace LibreNMS\Snmptrap\Handlers;

use App\Models\Device;
use LibreNMS\Enum\Severity;
use LibreNMS\Interfaces\SnmptrapHandler;
use LibreNMS\Snmptrap\Trap;

class XklEdfaAlarmChange implements SnmptrapHandler
{
    /**
     * Handle snmptrap.
     * Data is pre-parsed and delivered as a Trap.
     *
     * @param Device $device
     * @param Trap $trap
     * @return void
     */
    public function handle(Device $device, Trap $trap)
    {
        /**
        * Handle snmptrap.
        * Data is pre-parsed and delivered as a Trap.
        *
        * @param  Device  $device
        * @param  Trap  $trap
        * @return void
        */

        $severity = Severity::Warning;
        $edfaName = $trap->getOidData($trap->findOid('XKL-MIB::xklEDFAName'));

        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFAInReset')) == 2) {
            $message = "$edfaName reset.";
        } 
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFADisabled')) == 2) {
            $message = "$edfaName changed to disabled.";
        }
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFAMuted')) == 2) {
            $message = "$edfaName has become muted.";
        }
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFACaseTemperatureAlarm')) == 2) {
            $message = "$edfaName case temperature alarm is active.";
        }
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFACommonAlarm')) == 2) {
            $message = "$edfaName common alarm is active.";
        }
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFAPumpTemperatureAlarm')) == 2) {
            $message = "$edfaName pump temperature alarm is active.";
        }
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFAPumpBiasAlarm')) == 2) {
            $message = "$edfaName loss of input alarm is active.";
        }
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFALossOfInputAlarm')) == 2) {
            $message = "$edfaName loss of input alarm is active.";
        }
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFALossOfOutputAlarm')) == 2) {
            $message = "$edfaName loss of output alarm is active.";
        }
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFALossOfOutputAlarm')) == 2) {
            $message = "$edfaName loss of output alarm is active.";
        }
        if ($trap->getOidData($trap->findOid('XKL-MIB::xklEDFAModuleAlarms')) != "NONE") {
            $message = "$edfaName module alarm: $trap->getOidData($trap->findOid('XKL-MIB::xklEDFAModuleAlarms'))";
        }

		$trap->log($message,$severity);
    }
}
