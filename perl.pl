#!/usr/bin/perl
use strict;
use warnings;

sub search_word_in_files {
    my ($word, $directory) = @_;
    my @result;

    find(
        sub {
            return unless -f $_ && /\.php$/;
            my $file_path = $File::Find::name;

            open my $fh, '<', $file_path or die "Could not open file $file_path: $!";
            my $content = do { local $/; <$fh> };

            if ($content =~ /$word/) {
                my $relative_path = File::Spec->abs2rel($file_path, $directory);
                push @result, {
                    'path' => $relative_path,
                    'permissions' => sprintf "%o", (stat($file_path))[2] & 07777
                };
            }
        },
        $directory
    );

    return @result;
}

sub print_search_results {
    my @results = @_;

    if (!@results) {
        print "Kata tidak ditemukan dalam file-file PHP di direktori dan subdirektori.\n";
    } else {
        print "\nSearch Results:\n";
        printf("%-50s %-12s %-12s\n", "File Path", "Permissions", "Action");
        print "=" x 80, "\n";

        foreach my $file_info (@results) {
            my $file_path = $file_info->{'path'};
            my $permissions = $file_info->{'permissions'};

            printf("%-50s %-12s %-12s\n", $file_path, $permissions, "View");
        }
    }
}

use File::Find;
use File::Spec;

my $word = shift @ARGV;
my $directory = shift @ARGV || '.';

my @search_result = search_word_in_files($word, $directory);
print_search_results(@search_result);
