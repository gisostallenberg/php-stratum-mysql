#!/bin/bash -e -x

mysql -v -uroot -h127.0.0.1      < test/ddl/0010_create_database.sql
mysql -v -uroot -h127.0.0.1      < test/ddl/0020_create_user.sql
mysql -v -uroot -h127.0.0.1 test < test/ddl/0100_create_tables.sql

if [[ -L test/psql/oracle ]]; then
  rm test/psql/oracle
fi

mysql -utest -ptest -h127.0.0.1 test -e "set SQL_MODE='ORACLE'" 2>&1 > /dev/null
if [[ $? -eq 0 ]]; then
  ln -s ../oracle test/psql/oracle
fi

if [[ -L test/psql/inet6 ]]; then
  rm test/psql/inet6
fi

mysql -utest -ptest -h127.0.0.1 test -e "create temporary table IPv6(ip inet6)" 2>&1 > /dev/null
if [[ $? -eq 0 ]]; then
  ln -s ../inet6 test/psql/inet6

  cat test/ddl/0100_create_tables_inet6.sql | mysql -v -uroot -h127.0.0.1 test
fi

