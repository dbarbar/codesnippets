# Opening a port through the iptables firewall

Add this line to /etc/sysconfig/iptables to open port 80.

    -A RH-Firewall-1-INPUT -m state --state NEW -m tcp -p tcp --dport 80 -j ACCEPT

Restart iptables.

    /etc/init.d/iptables restart

See [this page](http://www.cyberciti.biz/faq/howto-rhel-linux-open-port-using-iptables/)
