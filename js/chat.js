const applyStyles = iframe => {
	let styles = {
		fontColor: "#FFF",
        fontGoogleName: "Inconsolata",
        backgroundColor : "rgba(0,0,0,0)",
        fontSize:"clamp(1.5rem, 1.326rem + 0.698vw, 3.0rem)",
        inputBackgroundColor:"transparent",
        inputFontColor:"white",
        hideIcons: true,
	}
	
	iframe.contentWindow.postMessage(JSON.stringify(styles), "*");	
}

// document.querySelector(".chat-stats").style.backgroundColor = "white";
// document.getElementsByClassName("chat-stats").style 
// tout les messages du chat /chat
//  /chat/new
// /chat/new {key : ..., message : "Hello world"}

// // Backend code
// import React, { Component} from 'react';
// import ApiWrapper from '../utils/api-wrapper';

// export default class Chat extends Component {

// 	constructor(props) {
// 		super(props);

// 		this.state = {
// 			chatMessages : [],
// 			fontSize : null,
// 			fontColor : null,
// 			hideIcons : false,
// 			fontGoogleName : null,
// 			backgroundColor : null,
// 			inputBackgroundColor : null,
// 			connectedUsers: [],
// 			games : [],
// 			showConnectedUsers : false,
// 			showGames : false,
// 		};

// 		this.lastMsgs = null;
// 		this.lastMsg = "";
// 		this.hasNewMsg = false;

// 		window.onmessage = (evt) => {
// 			try {
// 				let data = JSON.parse(evt.data);
// 				let refreshRoom = true;
// 				let state = {};

// 				if (data.fontSize != null) {
// 					state.fontSize = data.fontSize;
// 				}
// 				if (data.fontColor != null) {
// 					state.fontColor = data.fontColor;
// 				}
// 				if (data.fontGoogleName != null) {
// 					state.fontGoogleName = data.fontGoogleName;
// 				}
// 				if (data.backgroundColor != null) {
// 					state.backgroundColor = data.backgroundColor;
// 				}
// 				if (data.inputBackgroundColor != null) {
// 					state.inputBackgroundColor = data.inputBackgroundColor;
// 				}
// 				if (data.inputFontColor != null) {
// 					state.inputFontColor = data.inputFontColor;
// 				}
// 				if (data.hideIcons != null && data.hideIcons) {
// 					state.hideIcons = true;
// 				}
// 				if (data.requestFocus != null) {
// 					document.querySelector("textarea").focus();
// 					refreshRoom = false;
// 				}

// 				if (data.requestData != null) {
// 					evt.source.postMessage(JSON.stringify({
// 						userCount : this.state.connectedUsers.length,
// 						hasNewMsg : this.hasNewMsg
// 					},
// 					), evt.origin);
// 					refreshRoom = false;
// 					this.hasNewMsg = false;
// 				}

// 				this.setState(state, () => {
// 					if (refreshRoom) {
// 						this.updateChatroom();
// 					}
// 				})
// 			}
// 			catch (err) {
// 				console.log(err);
// 			}
// 		}

// 		window.onfocus = () => {
// 			this.focused = true;
// 		}

// 		window.onblur = () => {
// 			this.focused = false;
// 		}

// 		this.focused = false;
// 	}

// 	updateChatroom() {
// 		clearTimeout(this.setTimeoutId);

// 		let data = {
// 			key : this.props.match.params.key
// 		};

// 		ApiWrapper.fetch(this, "/api/chat", data, false)
// 			.then(response => {
// 				if (response === "INVALID_KEY") {
// 					let msgs = [{
// 						id : -1,
// 						fromUser : "ChatRoom",
// 						isAutoMessage : true,
// 						text : "Invalid key"
// 					}];

// 					this.setState({
// 						chatMessages : msgs,
// 						games : [],
// 						connectedUsers : []
// 					});
// 				}
// 				else {
// 					if (response.msgs.length > 0) {
// 						if (this.lastMsgs !== response.msgs[response.msgs.length - 1].text) {

// 							if (this.lastMsgs !== null && !this.focused) {
// 								this.hasNewMsg = true;
// 							}

// 							this.lastMsgs = response.msgs[response.msgs.length - 1].text;
// 						}
// 					}

// 					let modifiedMessages = response.msgs;

// 					this.setState({
// 						chatMessages : modifiedMessages,
// 						games : response.games,
// 						connectedUsers : response.connectedUsers
// 					});

// 					setTimeout(() => {
// 						let msgBox = document.querySelector(".chat-msgs");

// 						if (this.state.chatMessages.length > 0 &&
// 							this.lastMsg !== this.state.chatMessages[this.state.chatMessages.length - 1].id) {
// 							this.lastMsg = this.state.chatMessages[this.state.chatMessages.length - 1].id;
// 							msgBox.scrollTop = msgBox.scrollHeight;
// 						}
// 					}, 1);

// 					this.setTimeoutId = setTimeout(() => {
// 						this.updateChatroom()
// 					}, 2500);
// 				}
// 			}
// 		);
// 	}

// 	checkAddMessage(addedChar, field) {
// 		if (addedChar === 13) {
// 			if (field.value.trim().length > 0) {
// 				let data = {
// 					key : this.props.match.params.key,
// 					message : field.value
// 				};

// 				field.value = "";

// 				ApiWrapper.fetch(this, "/api/chat/new", data, false)
// 					.then(response => {
// 						if (response === "INVALID_KEY") {
// 							let msgs = [{
// 								id : -1,
// 								fromUser : "ChatRoom",
// 								isAutoMessage : true,
// 								text : "Invalid key"
// 							}];

// 							this.setState({
// 								chatMessages : msgs
// 							});
// 						}
// 						else {
// 							this.updateChatroom()
// 						}
// 					}
// 				);
// 			}
// 			else {
// 				field.value = "";
// 			}
// 		}
// 	}

// 	toggleShowGames() {
// 		this.setState({
// 			showGames : !this.state.showGames
// 		})
// 	}

// 	toggleShowConnectedUsers() {
// 		this.setState({
// 			showConnectedUsers : !this.state.showConnectedUsers
// 		})
// 	}

// 	componentWillUnmount() {
// 		if (this.setTimeoutId != null) clearTimeout(this.setTimeoutId);
// 		this.setTimeoutId = null;
// 	}

// 	componentWillMount() {
// 		this.updateChatroom();
// 	}

// 	render() {
// 		let mainStyles = {}
// 		let styles = {}
// 		let statsStyles = {}
// 		let inputStyles = {}

// 		if (this.state.backgroundColor != null) {
// 			mainStyles["backgroundColor"] = this.state.backgroundColor;
// 		}
// 		if (this.state.fontSize != null) {
// 			styles["fontSize"] = this.state.fontSize;
// 			statsStyles["fontSize"] = this.state.fontSize;
// 			inputStyles["fontSize"] = this.state.fontSize;
// 		}
// 		if (this.state.fontColor != null) {
// 			styles["color"] = this.state.fontColor;
// 			statsStyles["color"] = this.state.fontColor;
// 			inputStyles["color"] = this.state.fontColor;
// 		}
// 		if (this.state.fontGoogleName != null) {
// 			styles["fontFamily"] = "'" + this.state.fontGoogleName.replace(/\+/g, " ") + "'";
// 			statsStyles["fontFamily"] = "'" + this.state.fontGoogleName.replace(/\+/g, " ") + "'";
// 			inputStyles["fontFamily"] = "'" + this.state.fontGoogleName.replace(/\+/g, " ") + "'";
// 		}

// 		if (this.state.showGames || this.state.showConnectedUsers) {
// 			statsStyles["backgroundColor"] = "rgba(255, 255, 255, 0.7)";
// 		}

// 		if (this.state.inputBackgroundColor != null) {
// 			inputStyles["backgroundColor"] = this.state.inputBackgroundColor;
// 		}

// 		if (this.state.inputFontColor != null) {
// 			inputStyles["color"] = this.state.inputFontColor;
// 		}

// 		return (
// 			<div className={"chat-room " + (this.props.match.params.size != null ? "chat-size-" + this.props.match.params.size : "")} style={mainStyles}>
// 				{
// 					this.state.fontGoogleName != null ?
// 							<link href={"https://fonts.googleapis.com/css?family=" + this.state.fontGoogleName.replace(/\s/g, "+") + "&display=swap"} rel="stylesheet" />
// 						:
// 							null
// 				}
// 				<div className="chat-msgs">
// 					{
// 						this.state.chatMessages.map(msg => {
// 							let rank = "cls-default";
// 							let titleSuffix = "";

// 							if (!msg.isAutoMessage) {
// 								titleSuffix = " (";
// 								if (msg.userTrophies >= 150) {
// 									rank = "cls-gold";
// 									titleSuffix += "Or : ";
// 								}
// 								else if (msg.userTrophies >= 75) {
// 									rank = "cls-silver";
// 									titleSuffix += "Argent : ";
// 								}
// 								else {
// 									rank = "cls-bronze";
// 									titleSuffix += "Bronze : ";
// 								}

// 								titleSuffix +=  " " + msg.userTrophies + " trophées)";
// 							}

// 							return <div className={"chat-msg " + (msg.isAutoMessage ? "auto-msg" : "")} key={msg.id} style={styles}>
// 								{
// 									msg.fromUser === "News" && msg.isAutoMessage ?
// 										<div style={{marginRight:0}}></div>
// 									:
// 									<div className={"cls-symbol cls-" + msg.userClass + " " + rank + (this.state.hideIcons ? " cls-hide" : "")} title={msg.userClass + titleSuffix}>{msg.fromUser}&nbsp;:&nbsp;</div>
// 								}
// 								{
// 									msg.isAutoMessage ?
// 										<div dangerouslySetInnerHTML={{__html : msg.text}}></div>
// 									:
// 										<div>{msg.text.replace("/</g", "&gt;")}</div>
// 								}
// 							</div>
// 						})
// 					}
// 				</div>

// 				<div className="chat-stats" style={statsStyles}>
// 					<div onClick={() => this.toggleShowGames()}>
// 						<span>{this.state.games.length}</span> partie(s) en cours
// 					</div>

// 					{
// 						this.state.showGames && this.state.games.length > 0 ?
// 							<div className="active-games">
// 								<hr />
// 								{
// 									this.state.games.map(g => {
// 										return <div key={g.p1 + "-" + g.p2}>
// 												- { g.p1 } (<span>{g.p1Hp}</span>) <span>/</span> { g.p2 } (<span>{g.p2Hp}</span>)
// 											</div>
// 									})
// 								}
// 							</div>
// 						:
// 							null
// 					}

// 					<div onClick={() => this.toggleShowConnectedUsers()}>
// 						<span>{this.state.connectedUsers.length }</span> usager(s) connecté(s)
// 					</div>
// 					{
// 						this.state.showConnectedUsers && this.state.connectedUsers.length > 0 ?
// 							<div className="connected-users">
// 								<hr />
// 								{
// 									this.state.connectedUsers.map(u => {
// 										return <div key={u.username} title={u.trophies + " trophées " + (u.name != null ? " (" + u.name + ")" : "")}>
// 												- { u.username } {u.winCount != null ? " => " + u.winCount + "/" + u.lossCount + "" : ""}
// 											</div>
// 									})
// 								}
// 							</div>
// 						:
// 							null
// 					}
// 				</div>

// 				<div className="chat-entry">
// 					<textarea cols="2" rows="2" style={inputStyles} onKeyUp={event => this.checkAddMessage(event.which, event.target)}></textarea>
// 				</div>
// 			</div>
// 		);
// 	}
// }