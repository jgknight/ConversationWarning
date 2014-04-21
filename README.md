## esoTalk – Conversation Warning plugin

- Define the rules of conversation before replying.

### Installation

Browse to your esoTalk plugin directory:
```
cd WEB_ROOT_DIR/addons/plugins/
```

Clone the ConversationWarning plugin repo into the plugin directory:
```
git clone git@github.com:esoTalk-plugins/ConversationWarning.git ConversationWarning
```

Chown the ConversationWarning plugin folder to the right web user:
```
chown -R apache:apache ConversationWarning/
```

### Translation

Add the following definitions to your translation file (or create a seperate definitions.ConversationWarning.php file):

```
$definitions["Add a Converstation Warning"] = "Add a Converstation Warning";
$definitions["Define the rules of a Conversation"] = "Define the rules of a Conversation";
$definitions["Edit Warning"] = "Edit Warning";
$definitions["Remove Warning"] = "Remove Warning";
```

The default translation for "Warning" should be editted as well, edit `definitions.php` and change:
```
$definitions["Warning"] = "Uh oh, something's not right!";
```
into:
```
$definitions["Warning"] = "Warning";
```
