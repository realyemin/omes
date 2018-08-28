using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace QVU.Classes.QueueLayer.EventArgsClasses {
	public class StatementsChangedEventArgs {
		public Terminaller.TerminalDurum NewStatement { get; set; }

		public StatementsChangedEventArgs( Terminaller.TerminalDurum _NewState ) {
			this.NewStatement = _NewState;
		}

	}
}
