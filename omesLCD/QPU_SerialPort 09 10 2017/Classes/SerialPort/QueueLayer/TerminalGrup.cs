using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QPU_SerialPort.Library.Classes;
using System.Collections;

namespace QPU_SerialPort.Classes.QueueLayer {
    public partial class TerminalGrup {

                                                public static DataTable GetGroupOfTerminal(string termID) {
            TerminalGrup termGrup = new TerminalGrup();
            return termGrup.Get("TID=" + termID, "GRPID", "Order By TGID DESC");
                    }
    }
}
